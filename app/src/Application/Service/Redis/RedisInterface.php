<?php

declare(strict_types=1);

namespace App\Application\Service\Redis;

use App\Application\Concerns\WithHashTable;

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
     * @return int
     */
    public function increment(string $key): int;

    /**
     * Get keys by pattern
     * 
     * @param string $pattern
     * @return array
     */
    public function getByPattern(string $pattern): array;


    /**
     * Increment hash table field
     * 
     * @param WithHashTable $hashTable
     * @param string $field
     * @param int $value
     * @return int
     */
    public function hashIncrement(WithHashTable $hashTable, string $field, int $value): int;

    /**
     * Get hash table values
     * 
     * @param WithHashTable $hashTable
     * @return array
     */
    public function hashGetAll(WithHashTable $hashTable): array;
}
