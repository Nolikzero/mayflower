<?php

declare(strict_types=1);

use Spiral\Scaffolder\Declaration;

/**
 * Scaffolder configuration.
 * @link https://spiral.dev/docs/basics-scaffolding
 * @see \Spiral\Scaffolder\Config\ScaffolderConfig
 */
return [
    // Default namespace for all declarations
    'namespace' => 'App',

    'declarations' => [
        Declaration\BootloaderDeclaration::TYPE => [
            'namespace' => 'Application\\Bootloader',
        ],
        Declaration\ConfigDeclaration::TYPE => [
            'namespace' => 'Application\\Config',
        ],
        Declaration\ControllerDeclaration::TYPE => [
            'namespace' => 'Application\\Endpoint\\Controller',
        ],
        Declaration\FilterDeclaration::TYPE => [
            'namespace' => 'Application\\Endpoint\\Filter',
        ],
        Declaration\MiddlewareDeclaration::TYPE => [
            'namespace' => 'Application\\Endpoint\\Middleware',
        ],
        Declaration\CommandDeclaration::TYPE => [
            'namespace' => 'Application\\Console',
        ],
        Declaration\JobHandlerDeclaration::TYPE => [
            'namespace' => 'Application\\Job',
        ],
    ],
];
