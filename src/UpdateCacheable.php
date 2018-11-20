<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */

namespace Swoftx\Db\Entity;

use Swoft\Core\ResultInterface;
use Swoftx\Db\Entity\Manager\ModelCacheManager;

trait UpdateCacheable
{
    public function update(): ResultInterface
    {
        $res = parent::update();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }

    public function save(): ResultInterface
    {
        $res = parent::save();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }

    public function delete(): ResultInterface
    {
        $res = parent::delete();
        // 重置缓存
        ModelCacheManager::delete($this);
        return $res;
    }
}
