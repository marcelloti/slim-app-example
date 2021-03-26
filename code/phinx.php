<?php

require_once __DIR__ . '/helpers/helpers.php';

return
[
    'paths' => [
        'migrations' => path_modules('/db/migrations'),
        'seeds' => path_modules('/db/seeds')
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => '192.168.80.11',
            'name' => 'exampleapp',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => '192.168.80.11',
            'name' => 'exampleapp',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => '192.168.80.11',
            'name' => 'exampleapp',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
