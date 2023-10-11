<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\Service\Redis\RedisInterface;
use App\Application\Service\Redis\RedisService;
use App\Application\Service\Statistic\CountryStatisticInterface;
use App\Application\Service\Statistic\CountryStatisticService;
use Spiral\Bootloader\DomainBootloader;
use Spiral\Core\BinderInterface;
use Spiral\Core\CoreInterface;
use Spiral\Domain\GuardInterceptor;

/**
 * @link https://spiral.dev/docs/http-interceptors
 */
final class AppBootloader extends DomainBootloader
{
    protected const SINGLETONS = [CoreInterface::class => [self::class, 'domainCore']];
    protected const INTERCEPTORS = [GuardInterceptor::class];

    public function defineBindings(): array
    {
        return [
            CountryStatisticInterface::class => CountryStatisticService::class,
        ];
    }

    public function defineSingletons(): array
    {
        return [
            RedisInterface::class => RedisService::class,
        ];
    }
}
