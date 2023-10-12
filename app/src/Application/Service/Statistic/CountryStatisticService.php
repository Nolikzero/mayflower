<?php

declare(strict_types=1);

namespace App\Application\Service\Statistic;

use App\Application\Concerns\WithHashTable;
use App\Application\Enums\HashTableCacheKey;
use App\Application\Service\Redis\RedisInterface;

final class CountryStatisticService implements CountryStatisticInterface, WithHashTable
{

    public function __construct(
        private readonly RedisInterface $redis
    ) {
    }

    /**
     * Increment country statistic
     * 
     * @param string $countryCode
     * @return void
     */
    public function increment(string $countryCode): void
    {
        $this->redis->hashIncrement($this, $countryCode, 1);
    }

    /**
     * Get all country statistics
     * 
     * @return array
     */
    public function getAll(): array
    {
        return $this->redis->hashGetAll($this);
    }

    public function getHashTableKey(): HashTableCacheKey
    {
        return HashTableCacheKey::COUNTRY_STATISTIC;
    }
}
