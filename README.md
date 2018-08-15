# swoft-entity-cache
Swoft 模型实体缓存

[![Build Status](https://travis-ci.org/limingxinleo/swoft-entity-cache.svg?branch=master)](https://travis-ci.org/limingxinleo/swoft-entity-cache)

## 环境变量
~~~dotenv
# 实体缓存超时时间
ENTITY_CACHE_TTL=3600
# 模型缓存前缀
ENTITY_PREFIX=prefix
~~~

## 使用
config/properties/app.php中增加对应自定义组件

~~~
return [
    ...
    'components' => [
        'custom' => [
            'Swoftx\\Db\\Entity\\',
        ],
    ],
];
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
