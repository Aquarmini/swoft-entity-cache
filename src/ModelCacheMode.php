<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity;

class ModelCacheMode
{
    const DELETE_CACHE_BEFORE_UPDATE = 1;

    const DELETE_CACHE_AFTER_UPDATE = 2;

    const RELOAD_CACHE_AFTER_UPDATE = 3;
}
