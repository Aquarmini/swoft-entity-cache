<?php

namespace Xin\Swoft\Db\Entity\Config;

use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;

/**
 * Class ModelCacheConfig
 * @Bean
 * @package Xin\Swoft\Db\Entity\Config
 */
class ModelCacheConfig
{
    /**
     * @Value(env="${ENTITY_CACHE_KEY}")
     * @var string
     */
    protected $cacheKey = 'entity:cache:%s:i:%s:t:%s:%s:%s';

    /**
     * @Value(env="${ENTITY_CACHE_TTL}")
     * @var int
     */
    protected $ttl = 3600;

    /**
     * @return string
     */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }

    /**
     * @param string $cacheKey
     */
    public function setCacheKey(string $cacheKey)
    {
        $this->cacheKey = $cacheKey;
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl(int $ttl)
    {
        $this->ttl = $ttl;
    }
}