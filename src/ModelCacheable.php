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

trait ModelCacheable
{
    /**
     * 从缓存中获得模型实体
     * @author limx
     * @param $id
     * @return self
     */
    public static function findOneByCache($id)
    {
        return ModelCacheManager::findOne($id, get_called_class());
    }

    public static function findAllByCache($ids)
    {
        return ModelCacheManager::findAll($ids, get_called_class());
    }

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
