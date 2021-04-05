<?php

if (session_status() !== 1){
    session_start();
}

// Instantiate the app
$frameworkSettings = require __DIR__ . '/src/Modules/Core/Loaders/FrameworkSettings.php';
$app = new \Slim\App($frameworkSettings);

// Set up dependencies
$dependencies = require __DIR__ . '/src/Modules/Core/Loaders/Dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/src/Modules/Core/Loaders/Middlewares.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/src/Modules/Core/Routing/RouteList.php';

$app->getContainer()->get('db');

return $app;