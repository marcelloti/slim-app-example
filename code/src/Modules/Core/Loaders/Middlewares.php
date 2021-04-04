<?php

use Slim\App;
use SlimExample\Modules\Core\Middlewares\CorsMiddleware;
use SlimExample\Modules\Core\Middlewares\AuthMiddleware;

return function (App $app) {
    $app->add(new CorsMiddleware);
    $app->add(new AuthMiddleware);
};
