<?php

$frameworkSettings = require __DIR__ . '/src/Modules/Core/Loaders/FrameworkSettings.php';

return
[
    'paths' => [
        'migrations' => SlimExample\Modules\Core\Helpers::pathModules('/Database/Migrations'),
        'seeds' => SlimExample\Modules\Core\Helpers::pathModules('/Database/Seeds')
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'default',
        'default' => [
            'adapter' => $frameworkSettings['settings']['db']['driver'],
            'host' => $frameworkSettings['settings']['db']['host'],
            'name' => $frameworkSettings['settings']['db']['database'],
            'user' => $frameworkSettings['settings']['db']['username'],
            'pass' => $frameworkSettings['settings']['db']['password'],
            'port' => $frameworkSettings['settings']['db']['port'],
            'charset' => $frameworkSettings['settings']['db']['charset'],
        ],
        'testing' => [
            'adapter' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_DRIVER', 'testing'),
            'host' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_HOST', 'testing'),
            'name' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_NAME', 'testing'),
            'user' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_USERNAME', 'testing'),
            'pass' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PASSWORD', 'testing'),
            'port' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PORT', 'testing'),
            'charset' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_CHARSET', 'testing'),
        ],
    ],
    'version_order' => 'creation'
];
