<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity;

use Swoft\Db\Model;

class ModelCache extends Model
{
    use QueryCacheable;
    use UpdateCacheable;
    use UpdateWithResultCacheable;
}
