<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Helper;

use Swoft\Helper\ComponentHelper;

class BeanHelper
{
    /**
     * 获取当前扩展需要扫描的Bean
     * @author limx
     * @return array
     */
    public static function getEntityCacheBeanScan()
    {
        $path = dirname(dirname(__DIR__));
        $namespace = ComponentHelper::getComponentNamespace('swoft-entity-cache', $path);
        return [
            $namespace => $path . DS . 'src'
        ];
    }

    /**
     * 获取连带项目App目录所有需要扫描的Bean
     * @author limx
     * @return array
     */
    public static function getBeanScan()
    {
        $appDir = alias('@app');
        $dirs = glob($appDir . '/*');

        $beanScan = [];
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                continue;
            }
            $nsName = basename($dir);
            $beanScan[] = sprintf('App\%s', $nsName);
        }

        $path = dirname(dirname(__DIR__));
        $namespace = ComponentHelper::getComponentNamespace('swoft-entity-cache', $path);
        $beanScan[$namespace] = $path . DS . 'src';
        return $beanScan;
    }
}
