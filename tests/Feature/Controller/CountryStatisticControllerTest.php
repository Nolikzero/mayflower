<?php

declare(strict_types=1);

namespace Tests\Feature\Controller;

use App\Application\Concerns\WithHashTable;
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
        $this->redisService->shouldReceive('hashIncrement')
            ->once()
            ->withArgs(fn(WithHashTable $hashTable, string $field, int $value) =>
                $hashTable->getHashTableKey()->getKey() === 'country_statistic'
                    && $field === 'ES'
                    && $value === 1
            )
            ->andReturn(1);

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic', [
            'countryCode' => 'es'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIncrementCountryStatisticValidationException()
    {
        $this->redisService->shouldReceive('hashIncrement')
            ->never();

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic', [
            'countryCode' => null
        ]);

        $this->assertEquals(422, $response->getStatusCode());
    }


    public function testIncrementCountryStatisticMissBodyValidationException()
    {
        $this->redisService->shouldReceive('hashIncrement')
            ->never();

        $http = $this->fakeHttp();

        $response = $http->post('/api/country-statistic');

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testGetAllCountryStatisticOk()
    {
        $this->redisService->shouldReceive('hashGetAll')
            ->once()
            ->withAnyArgs()
            ->andReturn([
                'ES' => 1,
                'FR' => 2,
                'IT' => 3,
            ]);

        $http = $this->fakeHttp();

        $response = $http->get('/api/country-statistic');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => [
                'ES' => 1,
                'FR' => 2,
                'IT' => 3,
            ]
        ], $response->getJsonParsedBody());
    }
}
