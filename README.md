# swoft-entity-cache
Swoft 模型实体缓存

[![Build Status](https://travis-ci.org/limingxinleo/swoft-entity-cache.svg?branch=master)](https://travis-ci.org/limingxinleo/swoft-entity-cache)

## 环境变量
~~~dotenv
# 实体缓存超时时间
ENTITY_CACHE_TTL=3600
~~~

## 使用
config/properties/app.php中增加对应beanScan
~~~
return [
    ...
    'beanScan' => require __DIR__ . DS . 'beanScan.php',
];

# beanScan.php 如下

use Swoftx\Db\Entity\Helper\BeanHelper;

$beanScan = [
    'App\\Breaker',
    'App\\Controllers',
    'App\\Core',
    'App\\Exception',
    'App\\Fallback',
    'App\\Lib',
    'App\\Listener',
    'App\\Middlewares',
    'App\\Models',
    'App\\Pool',
    'App\\Process',
    'App\\Services',
    'App\\Tasks',
    'App\\WebSocket',
];

$customBean = [
    'App\\Biz',
    'App\\Config',
    'App\\Jobs',
    'Swoftx\\Db\\Entity\\', // swoft/frameword v1.0.22以上版本才兼容这种写法
];

// swoft/frameword 全版本兼容的写法
$entityCacheBean = BeanHelper::getEntityCacheBeanScan();
$beanScan = array_merge($beanScan, $customBean, $entityCacheBean);
return $beanScan;
~~~

修改实体基类，增加ModelCacheable Trait
~~~php
<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace App\Models;

use Swoft\Db\Model;
use Swoftx\Db\Entity\ModelCacheable;

class ModelCache extends Model
{
    use ModelCacheable;
}
~~~

调用
~~~php
<?php
// 从Redis中拿模型实体
$user = User::findOneByCache(1);
~~~
