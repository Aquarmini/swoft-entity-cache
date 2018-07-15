<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
// | EventTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace SwoftTest\Db\Cases\Entity;

use SwoftTest\Db\Cases\AbstractMysqlCase;
use SwoftTest\Db\Testing\Entity\User;
use Xin\Swoft\Db\Entity\Config\ModelCacheConfig;
use Xin\Swoft\Db\Entity\Helper\BeanHelper;

class CacheTest extends AbstractMysqlCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testFind()
    {
        // 生成对应缓存
        $user = User::findOneByCache(1);

        $user2 = User::findById(1)->getResult();
        $user = User::findOneByCache(1);

        $this->assertEquals($user, $user2);
    }

    public function testFindNotExist()
    {
        $user = User::findOneByCache(11111);
        $this->assertNull($user);

        $user = User::findOneByCache(11111);
        $this->assertNull($user);
    }

    public function testModelCacheConfig()
    {
        $config = bean(ModelCacheConfig::class);
        
    }
}
