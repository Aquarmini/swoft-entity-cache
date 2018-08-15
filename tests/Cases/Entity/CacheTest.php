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
use Swoftx\Db\Entity\Config\ModelCacheConfig;

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

    public function testFindByCo()
    {
        go(function () {
            $this->testFind();
        });
    }

    public function testFindNotExist()
    {
        $user = User::findOneByCache(11111);
        $this->assertNull($user);

        $user = User::findOneByCache(11111);
        $this->assertNull($user);
    }

    public function testFindNotExistByCo()
    {
        go(function () {
            $this->testFindNotExist();
        });
    }

    public function testModelCacheConfig()
    {
        $config = bean(ModelCacheConfig::class);
        $this->assertEquals(env('ENTITY_CACHE_TTL'), $config->getTtl());
        $this->assertEquals(env('ENTITY_CACHE_PREFIX'), $config->getPrefix());
    }

    public function testModelCacheConfigByCo()
    {
        go(function () {
            $this->testModelCacheConfig();
        });
    }

    public function testUpdateAndDelete()
    {
        $name = 'oldName' . uniqid();
        $user = new User();
        $user->setName($name);
        $user->setRoleId(1);
        $user->setUpdatedAt(date('Y-m-d H:i:s'));
        $user->setCreatedAt(date('Y-m-d H:i:s'));
        $id = $user->save()->getResult();
        $this->assertTrue($id > 0);
        $this->assertEquals($name, $user->getName());

        $newName = 'newName' . uniqid();
        $user = User::findOneByCache($id);
        $user->setName($newName);
        $row = $user->update()->getResult();
        $this->assertEquals(1, $row);
        $this->assertEquals($newName, $user->getName());

        $user = User::findOneByCache($id);
        $this->assertEquals($newName, $user->getName());

        $user->delete()->getResult();
        $user = User::findOneByCache($id);
        $this->assertNull($user);

        $user = User::findById($id)->getResult();
        $this->assertNull($user);
    }

    public function testUpdateAndDeleteByCo()
    {
        go(function () {
            $this->testUpdateAndDelete();
        });
    }
}
