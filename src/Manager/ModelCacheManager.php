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
use Swoftx\Db\Entity\Config\ModelCacheConfig;
use Swoftx\Db\Entity\Helper\EntityHelper;
use Swoft\Db\Model;
use Swoft\Redis\Redis;

class ModelCacheManager
{
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
     * @param $id
     * @return self
     */
    public static function findOne($id, $className)
    {
        $key = static::getCacheKey($id, $className);
        $redis = bean(Redis::class);
        $config = bean(ModelCacheConfig::class);

        if ($redis->exists($key)) {
            if ($redis->type($key) === \Redis::REDIS_HASH) {
                $data = $redis->hGetAll($key);
                $entity = EntityHelper::arrayToEntity($data, $className);
                return $entity;
            } else {
                return null;
            }
        }

        /** @var Model $object */
        $object = $className::findById($id)->getResult();

        static::setCache($id, $className, $object);

        return $object;
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
            $redis->expire($key, $config->getTtl());
        } elseif (is_null($object)) {
            $redis->set($key, null, $config->getTtl());
        }
    }
}
