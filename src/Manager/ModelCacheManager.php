<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Manager;

use Swoft\App;
use Swoft\Db\Bean\Collector\EntityCollector;
use Swoft\Db\Exception\DbException;
use Swoft\Helper\StringHelper;
use Swoftx\Db\Entity\Config\ModelCacheConfig;
use Swoftx\Db\Entity\Helper\EntityHelper;
use Swoft\Db\Model;
use Swoft\Redis\Redis;
use Swoftx\Db\Entity\Memory\LuaSha;
use Swoftx\Db\Entity\Operator\Hashs\HashsGetMultiple;

class ModelCacheManager
{
    const ENTITY_NOT_FIND_KEY = 'entity:empty';
    const ENTITY_NOT_FIND_VALUE = '1';

    public static function getPrimaryKey($className)
    {
        $collect = EntityCollector::getCollector();
        if (!isset($collect[$className])) {
            throw new DbException("EntityCollector 中不存在当前实体[{$className}]");
        }

        $idColumn = $collect[$className]['table']['id'];
        return $idColumn;
    }

    /**
     * 获取缓存KEY
     * @author limx
     * @param $id
     * @return string
     * @throws DbException
     */
    public static function getCacheKey($id, $className)
    {
        $collect = EntityCollector::getCollector();
        if (!isset($collect[$className])) {
            throw new DbException("EntityCollector 中不存在当前实体[{$className}]");
        }

        $instance = $collect[$className]['instance'];
        $table = $collect[$className]['table']['name'];
        $idColumn = $collect[$className]['table']['id'];

        if (!App::hasBean(ModelCacheConfig::class)) {
            throw new DbException('请使用BeanHelper::getBeanScan获取需要扫描的Bean，并填入beanScan中');
        }

        $config = bean(ModelCacheConfig::class);
        $prefix = $config->getPrefix();
        return sprintf($config->getCacheKey(), $prefix, $instance, $table, $idColumn, $id);
    }

    /**
     * 从缓存中获得模型实体
     * @author limx
     * @param $id 实体主键
     * @return self
     */
    public static function findOne($id, $className)
    {
        $key = static::getCacheKey($id, $className);
        $redis = bean(Redis::class);
        $config = bean(ModelCacheConfig::class);

        $type = $redis->type($key);
        if ($type === \Redis::REDIS_HASH) {
            $data = $redis->hGetAll($key);
            if (static::check($data)) {
                $entity = EntityHelper::arrayToEntity($data, $className);
                return $entity;
            }
            return null;
        } elseif ($type !== \Redis::REDIS_NOT_FOUND) {
            return null;
        }

        /** @var Model $object */
        $object = $className::findById($id)->getResult();

        static::setCache($id, $className, $object);

        return $object;
    }

    /**
     * 从缓存中获取模型实体列表
     * @author limx
     * @param $ids       实体主键ID列表
     * @param $className 类名
     * @return self
     */
    public static function findAll($ids, $className)
    {
        if (empty($ids)) {
            return [];
        }

        $keys = [];
        foreach ($ids as $id) {
            $keys[] = static::getCacheKey($id, $className);
        }

        $redis = bean(Redis::class);
        $config = bean(ModelCacheConfig::class);
        $idColumn = static::getPrimaryKey($className);
        $idMethod = 'get' . StringHelper::studly($idColumn);

        // 获取lua脚本对用的sha
        $luaSha = bean(LuaSha::class);
        $sha = $luaSha->get(HashsGetMultiple::class);
        $command = new HashsGetMultiple();

        // 批量获取缓存
        if (!empty($sha) && $config->isLoadScript()) {
            $list = $redis->evalSha($sha, $keys, count($keys));
        } else {
            $script = $command->getScript();
            $list = $redis->eval($script, $keys, count($keys));
        }

        $list = is_array($list) ? $list : [];
        $list = $command->parseResponse($list);

        // 将缓存组装成实体
        $result = [];
        foreach ($list as $item) {
            if (static::check($item)) {
                $entity = EntityHelper::arrayToEntity($item, $className);
                $result[$entity->$idMethod()] = $entity;
            }
        }

        // 验证缺少哪些实体
        $targetIds = array_diff($ids, array_keys($result));
        foreach ($targetIds as $id) {
            $result[$id] = static::findOne($id, $className);
        }

        return $result;
    }

    /**
     * 删除缓存
     * @author limx
     * @param $id
     * @param $className
     * @return bool
     */
    public static function deleteOne($id, $className)
    {
        $key = static::getCacheKey($id, $className);
        $redis = bean(Redis::class);
        return $redis->delete($key);
    }

    /**
     * 设置缓存
     * @author limx
     * @param $id
     * @param $className
     */
    public static function setCache($id, $className, $object)
    {
        $key = static::getCacheKey($id, $className);
        $redis = bean(Redis::class);
        $config = bean(ModelCacheConfig::class);

        if ($object instanceof $className) {
            $attrs = $object->toArray();
            $redis->hMset($key, $attrs);
        } elseif (is_null($object)) {
            $redis->hSet($key, self::ENTITY_NOT_FIND_KEY, self::ENTITY_NOT_FIND_VALUE);
        }
        $redis->expire($key, $config->getTtl());
    }

    /**
     * 检测缓存是否合法
     * @author limx
     * @param $data
     */
    public static function check($data)
    {
        if (isset($data[self::ENTITY_NOT_FIND_KEY])) {
            return false;
        }
        return true;
    }
}
