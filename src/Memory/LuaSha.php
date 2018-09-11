<?php
namespace Swoftx\Db\Entity\Memory;

use Swoft\Bean\Annotation\Bean;
use Swoft\Redis\Redis;
use Swoftx\Db\Entity\Exceptions\EntityCacheException;
use Swoftx\Db\Entity\Operator\OperatorInterface;

/**
 * Class LuaSha
 * @Bean
 */
class LuaSha
{
    public $luaSha = [];

    public function get($OperatorName)
    {
        if (!class_exists($OperatorName)) {
            throw new EntityCacheException("Operator {$OperatorName} is not exist!");
        }

        if (isset($this->luaSha[$OperatorName])) {
            return $this->luaSha[$OperatorName];
        }

        $redis = bean(Redis::class);
        /** @var OperatorInterface $object */
        $object = new $OperatorName();
        $sha = $redis->script('load', $object->getScript());

        return $this->luaSha[$OperatorName] = $sha;
    }
}