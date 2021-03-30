<?php

namespace SlimExample\Modules\Users;

use SlimExample\Modules\Core\Routing\Route;

use Slim\Http\Request;
use Slim\Http\Response;

use SlimExample\Modules\Users\Controllers\UsersController;

class UsersRoute extends Route {
  public function create(): void {
    /**
     * @OA\Get(
     *     path="/api/users",
     *     @OA\Response(
     *      response="200",
     *      description="List users"
     *     )
     * )
     */
    $this->app->get('/api/users', function(Request $request, Response $response, array $args): Response {
        return UsersController::get($request, $response, $args);
    });

    /**
     * @OA\Post(
     *     path="/api/users",
     *     @OA\Response(
     *      response="200",
     *      description="Create user"
     *     )
     * )
     */
    $this->app->post('/api/users', function(Request $request, Response $response, array $args): Response {
        return UsersController::post($request, $response, $args);
    });

    /**
     * @OA\Put(
     *     path="/api/users",
     *     @OA\Response(
     *      response="200",
     *      description="Update user"
     *     )
     * )
     */
    $this->app->put('/api/users', function(Request $request, Response $response, array $args): Response {
        return UsersController::put($request, $response, $args);
    });

    /**
     * @OA\Delete(
     *     path="/api/users",
     *     @OA\Response(
     *      response="200",
     *      description="Delete user"
     *     )
     * )
     */
    $this->app->delete('/api/users', function(Request $request, Response $response, array $args): Response {
        return UsersController::delete($request, $response, $args);
    });
  }
}
