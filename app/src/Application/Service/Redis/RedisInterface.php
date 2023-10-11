<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;

interface RedisInterface
{
    /**
     * Get value by key
     * 
     * @param string $key
     * @return string
     */
    public function get(string $key): string;

    /**
     * Increment value by key
     * 
     * @param string $key
     * @return void
     */
    public function increment(string $key): void;

    /**
     * Get keys by pattern
     * 
     * @param string $pattern
     * @return array
     */
    public function getByPattern(string $pattern): array;
}
