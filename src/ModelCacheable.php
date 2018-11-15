<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity;

use Swoft\Core\ResultInterface;
use Swoft\Helper\StringHelper;
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
        $idColumn = ModelCacheManager::getPrimaryKey(get_called_class());
        $getterMethod = StringHelper::camel('get_' . $idColumn);

        $res = parent::update();
        // 重置缓存
        ModelCacheManager::deleteOne($this->$getterMethod(), get_called_class(), $this);
        return $res;
    }

    public function save(): ResultInterface
    {
        $idColumn = ModelCacheManager::getPrimaryKey(get_called_class());
        $getterMethod = StringHelper::camel('get_' . $idColumn);

        $res = parent::save();
        // 重置缓存
        ModelCacheManager::deleteOne($this->$getterMethod(), get_called_class());
        return $res;
    }

    public function delete(): ResultInterface
    {
        $idColumn = ModelCacheManager::getPrimaryKey(get_called_class());
        $getterMethod = StringHelper::camel('get_' . $idColumn);

        $res = parent::delete();
        ModelCacheManager::deleteOne($this->$getterMethod(), get_called_class());
        return $res;
    }
}
