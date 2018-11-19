<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Memory;

use Swoft\Bean\Annotation\Bean;
use Swoft\Contract\Arrayable;
use Swoft\Redis\Redis;
use Swoftx\Db\Entity\Exceptions\EntityCacheException;
use Swoftx\Db\Entity\Operator\OperatorInterface;

/**
 * Class LuaSha
 * @Bean
 */
class LuaSha implements Arrayable
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

    public function toArray(): array
    {
        return $this->luaSha;
    }
}
