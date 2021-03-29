<?php

namespace SlimExample\Modules\Core;

use SlimExample\Modules\Core\Routing\Route;
use Slim\Http\Request;
use Slim\Http\Response;

class CoreRoute extends Route {
  public function create(): void {
    $this->app->get('/', function(Request $request, Response $response, array $args): Response {
      return $response->withJson('API ONLINE');
    });
  }
}
