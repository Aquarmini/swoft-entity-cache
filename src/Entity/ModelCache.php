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

class ModelCache extends Model
{
    const CACHE_KEY = 'entity:cache:%s:i:%s:t:%s:%s:%s';

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

    public static function findOneByCache($id)
    {
        $className = get_called_class();
        $key = static::getCacheKey($id);
        $redis = bean(Redis::class);
        if ($redis->exists($key)) {
            $data = $redis->hGetAll($key);
            $entity = EntityHelper::arrayToEntity($data, $className);
            return $entity;
        }

        /** @var Model $object */
        $object = static::findById($id)->getResult();
        $attrs = $object->getAttrs();
        $redis->hMset($key, $attrs);
        $redis->expire($key, env('ENTITY_CACHE_TTL', 3600));
        return $object;
    }
}
