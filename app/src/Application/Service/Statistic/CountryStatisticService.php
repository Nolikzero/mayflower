<?php

declare(strict_types=1);

namespace App\Application\Service\Statistic;

use App\Application\Service\Redis\RedisInterface;
use Psr\SimpleCache\CacheInterface;
use Spiral\Cache\CacheStorageProviderInterface;

final class CountryStatisticService implements CountryStatisticInterface
{

    private static string $prefix = 'country_statistic_';
    private RedisInterface $redis;

    public function __construct(RedisInterface $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Increment country statistic
     * 
     * @param string $countryCode
     * @return void
     */
    public function increment(string $countryCode): void
    {
        $this->redis->increment($this->getCacheKey($countryCode));
    }

    /**
     * Get all country statistics
     * 
     * @return array
     */
    public function getAll(): array
    {
        $keys = $this->redis->getByPattern(self::$prefix . '*'); # keys

        $result = [];

        foreach ($keys as &$key) {
            $countryCode = str_replace(self::$prefix, '', $key);
            $result[] = [
                $countryCode => (int)$this->redis->get($key)
            ];
        }

        return $result;
    }

    /**
     * Get cache key
     * 
     * @param string $countryCode
     * @return string
     */
    private function getCacheKey(string $countryCode): string
    {
        return self::$prefix . $countryCode;
    }
}
