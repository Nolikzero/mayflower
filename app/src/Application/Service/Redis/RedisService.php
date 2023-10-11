<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;
use App\Application\Config\RedisConfig;
use Predis\Client;

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
    public function increment(string $key): void
    {
        $this->redis->incr($key);
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
}
