<?php

declare(strict_types=1);

namespace App\Application\Concerns;

use App\Application\Enums\HashTableCacheKey;

interface WithHashTable {
    public function getHashTableKey(): HashTableCacheKey;
}