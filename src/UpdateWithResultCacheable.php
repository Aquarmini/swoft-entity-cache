<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */

namespace Swoftx\Db\Entity;

use Swoftx\Db\Entity\Manager\ModelCacheManager;

trait UpdateWithResultCacheable
{
    public function saveModel()
    {
        $res = parent::save()->getResult();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }

    public function updateModel()
    {
        $res = parent::update()->getResult();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }

    public function deleteModel()
    {
        $res = parent::delete()->getResult();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }
}
