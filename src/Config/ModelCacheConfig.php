<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <715557344@qq.com>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Config;

use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Value;
use Swoftx\Db\Entity\ModelCacheMode;

/**
 * Class ModelCacheConfig
 * @Bean()
 * @package Swoftx\Db\Entity\Config
 */
class ModelCacheConfig
{
    /**
     * @Value(env="${ENTITY_CACHE_KEY}")
     * @var string
     */
    protected $cacheKey = 'entity:cache:%s:i:%s:t:%s:%s:%s';

    /**
     * @Value(env="${ENTITY_CACHE_PREFIX}")
     * @var string
     */
    protected $prefix = APP_NAME;

    /**
     * @Value(env="${ENTITY_CACHE_TTL}")
     * @var int
     */
    protected $ttl = 3600;

    /**
     * @Value(env="${ENTITY_CACHE_UPDATE_MODE}")
     * @var int
     */
    protected $updateMode = ModelCacheMode::DELETE_CACHE_BEFORE_UPDATE;

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

    /**
     * @return int
     */
    public function getUpdateMode(): int
    {
        return $this->updateMode;
    }

    /**
     * @param int $updateMode
     */
    public function setUpdateMode(int $updateMode)
    {
        $this->updateMode = $updateMode;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;
    }
}
