<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Xin\Swoft\Db\Entity\Helper;

use Swoft\Helper\ComponentHelper;

class BeanHelper
{
    public static function getBeanScan()
    {
        $path = dirname(dirname(__DIR__));
        $namespace = ComponentHelper::getComponentNamespace('swoft-entity-cache', $path);
        return [
            $namespace => $path . DS . 'src'
        ];
    }
}
