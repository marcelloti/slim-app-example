<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'driver' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_DRIVER'),
            'host' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_HOST'),
            'port' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PORT'),
            'database' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_NAME'),
            'username' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_USERNAME'),
            'password' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PASSWORD'),
            'charset' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_CHARSET'),
            'collation' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_COLLATION'),
            'prefix' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PREFIX'),
        ]
    ],
];
