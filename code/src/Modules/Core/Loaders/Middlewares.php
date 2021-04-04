<?php

use Slim\App;
use SlimExample\Modules\Core\Middlewares\CorsMiddleware;

return function (App $app) {
    $app->add(new CorsMiddleware);
};
