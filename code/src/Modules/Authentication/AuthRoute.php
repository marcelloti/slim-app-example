<?php

namespace SlimExample\Modules\Authentication;

use SlimExample\Modules\Core\Routing\Route;
use SlimExample\Modules\Authentication\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

use SlimExample\Modules\Authentication\Controllers\AuthenticationController;

class AuthRoute extends Route {
  public function create(): void {
    /**
     * @OA\Post(
     *     path="/api/login",
     *     @OA\Response(
     *      response="200",
     *      description="Login route"
     *     )
     * )
     */
    $this->app->post('/api/login', function(Request $request, Response $response, array $args): Response {
      return AuthenticationController::login($request, $response, $args);
    });
  }
}
