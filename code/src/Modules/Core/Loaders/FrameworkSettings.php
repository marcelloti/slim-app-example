<?php

$env = SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv();

$databasename = SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_NAME', $env);
if ($env === "testing") {
    $databasename .= ".sqlite3";
}

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
            'driver' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_DRIVER', $env),
            'host' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_HOST', $env),
            'port' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PORT', $env),
            'database' => $databasename,
            'username' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_USERNAME', $env),
            'password' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PASSWORD', $env),
            'charset' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_CHARSET', $env),
            'collation' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_COLLATION', $env),
            'prefix' => SlimExample\Acl\Infra\DotEnv\DotEnvLib::get('DATABASE_PREFIX', $env),
        ]
    ],
];
