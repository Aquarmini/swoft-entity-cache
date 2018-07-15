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
}