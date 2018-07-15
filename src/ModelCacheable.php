<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Xin\Swoft\Db\Entity;

use Swoft\Db\Bean\Collector\EntityCollector;
use Swoft\Db\Exception\DbException;
use Xin\Swoft\Db\Entity\Helper\EntityHelper;
use Swoft\Db\Model;
use Swoft\Redis\Redis;

trait ModelCacheable
{
    /**
     * 获取缓存KEY
     * @author limx
     * @param $id
     * @return string
     * @throws DbException
     */
    protected static function getCacheKey($id)
    {
        $collect = EntityCollector::getCollector();
        $className = get_called_class();
        if (!isset($collect[$className])) {
            throw new DbException("EntityCollector 中不存在当前实体[{$className}]");
        }

        $instance = $collect[$className]['instance'];
        $table = $collect[$className]['table']['name'];
        $idColumn = $collect[$className]['table']['id'];
        return sprintf(static::CACHE_KEY, APP_NAME, $instance, $table, $idColumn, $id);
    }

    /**
     * 从缓存中获得模型实体
     * @author limx
     * @param $id
     * @return object|Model
     */
    public static function findOneByCache($id)
    {
        $className = get_called_class();
        $key = static::getCacheKey($id);
        $redis = bean(Redis::class);
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
        $object = static::findById($id)->getResult();
        if ($object instanceof $className) {
            $attrs = $object->getAttrs();
            $redis->hMset($key, $attrs);
            $redis->expire($key, env('ENTITY_CACHE_TTL', 3600));
        } elseif (is_null($object)) {
            $redis->set($key, null, env('ENTITY_CACHE_TTL', 3600));
        }

        return $object;
    }
}
