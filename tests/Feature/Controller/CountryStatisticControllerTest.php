<?php

declare(strict_types=1);

namespace Tests\Feature\Controller;

use App\Application\Service\Redis\RedisInterface;
use Tests\TestCase;

final class CountryStatisticControllerTest extends TestCase
{

    private $redisService;

    public function setUp(): void
    {
        parent::setUp();

        $this->redisService = $this->mockContainer(RedisInterface::class);
    }

    public function testIncrementCountryStatisticOk()
    {
        $this->redisService->shouldReceive('increment')
            ->once()
            ->andReturn(1)
            ->with('country_statistic_ES');

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic', [
            'countryCode' => 'es'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIncrementCountryStatisticValidationException()
    {
        $this->redisService->shouldReceive('increment')
            ->never();

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic', [
            'countryCode' => null
        ]);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testIncrementCountryStatisticEmptyCountryCodeValidationException()
    {
        $this->redisService->shouldReceive('increment')
            ->never();

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic', [
            'countryCode' => null
        ]);

        $this->assertEquals(422, $response->getStatusCode());
    }


    public function testIncrementCountryStatisticMissBodyValidationException()
    {
        $this->redisService->shouldReceive('increment')
            ->never();

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic');

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testGetAllCountryStatisticOk()
    {
        $this->redisService->shouldReceive('getByPattern')
            ->once()
            ->andReturn([
                'country_statistic_ES',
                'country_statistic_FR',
                'country_statistic_IT',
            ]);

        $this->redisService->shouldReceive('get')
            ->times(3)
            ->andReturn(1, 2, 3);

        $http = $this->fakeHttp();

        $response = $http->get('/api/country-statistic');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => [
                [
                    'ES' => 1
                ],
                [
                    'FR' => 2
                ],
                [
                    'IT' => 3
                ]
            ]
        ], $response->getJsonParsedBody());
    }
}
