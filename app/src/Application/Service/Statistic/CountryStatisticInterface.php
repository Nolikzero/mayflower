<?php

declare(strict_types=1);

namespace App\Application\Service\Statistic;

interface CountryStatisticInterface
{

    /**
     * Increment country statistic
     * 
     * @param string $countryCode
     */
    public function increment(string $countryCode): void;

    /**
     * Get all country statistics
     * 
     * @return array
     */
    public function getAll(): array;
}
