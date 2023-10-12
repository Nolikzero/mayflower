<?php

declare(strict_types=1);

namespace App\Application\Endpoint\Controller;

use App\Application\Endpoint\Filter\CountryStatisticUpdateFilter;
use App\Application\Service\Statistic\CountryStatisticInterface;
use Psr\Http\Message\ResponseInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;

class CountryStatisticController
{
    use PrototypeTrait;

    public function __construct(
        private readonly CountryStatisticInterface $countryStatistic
    ) {
    }

    #[Route(route: '/country-statistic', group: 'api', methods: ['POST'])]
    public function increment(CountryStatisticUpdateFilter $filter): ResponseInterface
    {
        $this->countryStatistic->increment($filter->getCountryCode());
        return $this->response->create(200);
    }

    #[Route(route: '/country-statistic', group: 'api', methods: ['GET'])]
    public function get(): ResponseInterface
    {
        $result = $this->countryStatistic->getAll();
        return $this->response->json([
            'data' => $result
        ]);
    }
}
