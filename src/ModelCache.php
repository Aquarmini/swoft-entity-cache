<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Xin\Swoft\Db\Entity;

use Swoft\Db\Model;

class ModelCache extends Model
{
    use ModelCacheable;

    const CACHE_KEY = 'entity:cache:%s:i:%s:t:%s:%s:%s';
}
