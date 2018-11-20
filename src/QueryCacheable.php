<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */

namespace Swoftx\Db\Entity;

use Swoftx\Db\Entity\Manager\ModelCacheManager;

trait QueryCacheable
{
    /**
     * @param $id
     * @return self
     */
    public static function findOneByCache($id)
    {
        return ModelCacheManager::findOne($id, get_called_class());
    }

    /**
     * @param $ids
     * @return self[]
     */
    public static function findAllByCache($ids)
    {
        return ModelCacheManager::findAll($ids, get_called_class());
    }
}
