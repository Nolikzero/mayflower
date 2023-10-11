<?php

declare(strict_types=1);

namespace App\Application\Config;

use Spiral\Core\InjectableConfig;

final class RedisConfig extends InjectableConfig
{
    public const CONFIG = 'redis';

    /**
     * Default values for the config.
     * Will be merged with application config in runtime.
     */
    protected array $config = [
        'host' => '127.0.0.1',
        'port' => '6379',
        'database' => 0,
        'password' => ''
    ];

    public function getHost(): string
    {
        return $this->config['host'];
    }

    public function getPort(): string
    {
        return $this->config['port'];
    }

    public function getDatabase(): int
    {
        return (int)$this->config['database'];
    }

    public function getPassword(): string
    {
        return $this->config['password'];
    }
}
