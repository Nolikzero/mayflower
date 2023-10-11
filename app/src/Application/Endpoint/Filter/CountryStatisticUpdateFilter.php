<?php

declare(strict_types=1);

namespace App\Application\Endpoint\Filter;

use Spiral\Filters\Attribute\Input\Post;
use Spiral\Filters\Attribute\Setter;
use Spiral\Filters\Model\Filter;
use Spiral\Filters\Model\FilterDefinitionInterface;
use Spiral\Filters\Model\HasFilterDefinition;
use Spiral\Validator\FilterDefinition;

final class CountryStatisticUpdateFilter extends Filter implements HasFilterDefinition
{
    #[Post]
    #[Setter(filter: [self::class, 'uppercase'])]
    public string $countryCode;

    public function filterDefinition(): FilterDefinitionInterface
    {
        return new FilterDefinition([
            'countryCode' => ['required', ['string::length', 2]]
        ]);
    }

    public static function uppercase(string $value): string
    {
        return strtoupper($value);
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}
