<?php

declare(strict_types=1);

use Spiral\Cache\Storage\ArrayStorage;
use Spiral\Cache\Storage\FileStorage;

/**
 * Configuration for cache component.
 *
 * @link https://spiral.dev/docs/basics-cache
 */
return [
    /**
     * The default cache connection that gets used while using this caching library.
     */
    'default' => env('CACHE_STORAGE', 'rr-redis'),

    /**
     * Aliases, if you want to use domain specific storages.
     */
    'aliases' => [
        'country-data' => [
            'storage' => 'rr-redis',
            'prefix' => 'country_',
        ]
    ],

    /**
     * Here you may define all of the cache "storages" for your application as well as their types.
     */
    'storages' => [

        'rr-local' => [
            'type' => 'roadrunner',
            'driver' => 'local',
        ],

        'local' => [
            // Alias for ArrayStorage type
            'type' => 'array',
        ],

        'file' => [
            // Alias for FileStorage type
            'type' => 'file',
            'path' => directory('runtime') . 'cache',
        ],


        'rr-redis' => [
            'type' => 'roadrunner',
            'driver' => 'redis',
        ],
    ],

    /**
     * Aliases for storage types
     */
    'typeAliases' => [
        'file' => FileStorage::class,
    ],
];
