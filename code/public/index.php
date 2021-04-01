<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../autoload.php';

session_start();

// Instantiate the app
$frameworkSettings = require __DIR__ . '/../src/Modules/Core/Loaders/FrameworkSettings.php';
$app = new \Slim\App($frameworkSettings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/Modules/Core/Loaders/Dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/Modules/Core/Loaders/Middlewares.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/Modules/Core/Routing/RouteList.php';

$app->getContainer()->get('db');

// Run app
$app->run();
