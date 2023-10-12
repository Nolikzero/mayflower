<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;

use App\Application\Concerns\WithHashTable;
use App\Application\Config\RedisConfig;
use Predis\Client;
use Spiral\Core\Attribute\Finalize;
use Spiral\Core\Attribute\Singleton;

#[Singleton]
#[Finalize(method: 'disconnect')]
final class RedisService implements RedisInterface
{

    private readonly Client $redis;

    public function __construct(RedisConfig $redisConfig)
    {
        $this->redis = new Client([
            'scheme' => 'tcp',
            'host' => $redisConfig->getHost(),
            'port' => $redisConfig->getPort(),
            'database' => $redisConfig->getDatabase(),
            'password' => $redisConfig->getPassword()
        ]);
    }

    /**
     * Get value by key
     * 
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->redis->get($key);
    }

    /**
     * Increment value by key
     * 
     * @param string $key
     * @return void
     */
    public function increment(string $key): int
    {
        return $this->redis->incr($key);
    }

    /**
     * Get keys by pattern
     * 
     * @param string $pattern
     * @return array
     */
    public function getByPattern(string $pattern): array
    {
        return $this->redis->keys($pattern);
    }

    /**
     * Increment hash table field
     * 
     * @param WithHashTable $hashTable
     * @param string $field
     * @param int $value
     * @return int
     */
    public function hashIncrement(WithHashTable $hashTable, string $field, int $value): int
    {
        return $this->redis->hincrby($hashTable->getHashTableKey()->getKey(), $field, $value);
    }

    /**
     * Get hash table values
     * 
     * @param WithHashTable $hashTable
     * @return array
     */
    public function hashGetAll(WithHashTable $hashTable): array
    {
        return $this->redis->hgetall($hashTable->getHashTableKey()->getKey());
    }

    public function disconnect()
    {
        $this->redis->disconnect();
    }
}
