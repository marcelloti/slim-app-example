<?php

namespace SlimExample\Modules\Authentication;

use SlimExample\Modules\Core\Routing\Route;
use SlimExample\Modules\Authentication\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

use SlimExample\Modules\Authentication\Controllers\AuthenticationController;

class AuthRoute extends Route {
  public function create(): void {
    $this->app->post('/api/login', function(Request $request, Response $response, array $args): Response {
      return AuthenticationController::login($request, $response, $args);
    });

    $this->app->get('/api/users/list', function(Request $request, Response $response, array $args): Response {
      $users = User::get();
      return $response->withJson($users);

      //return 'list users';
    });

    $this->app->post('/api/users/create', function(Request $request, Response $response, array $args): Response {
      $data = $request->getParsedBody();
      $user = User::create($data);
      return $response->withJson($user);
    });
  }
}
