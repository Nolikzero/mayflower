<?php

declare(strict_types=1);

namespace App\Application\Enums;

enum HashTableCacheKey
{
    case COUNTRY_STATISTIC;

    public function getKey(): string
    {
        return match ($this) {
            self::COUNTRY_STATISTIC => 'country_statistic',
        };
    }
}