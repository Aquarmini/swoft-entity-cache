<?php
namespace Xin\Swoft\Db\Entity\Helper;

use Swoft\Db\Bean\Collector\EntityCollector;
use Swoft\Db\Exception\DbException;
use Swoft\Helper\ArrayHelper;
use Swoft\Helper\ComponentHelper;
use Swoft\Helper\StringHelper;
use Swoft\Db\Helper\EntityHelper as SwoftEntityHelper;

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