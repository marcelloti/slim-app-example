<?php

namespace SlimExample\Modules\Transactions;

use SlimExample\Modules\Core\Routing\Route;

use Slim\Http\Request;
use Slim\Http\Response;

use SlimExample\Modules\Transactions\Controllers\TransactionsController;

class TransactionsRoute extends Route {
  public function create(): void {
    /**
     * @OA\Get(
     *     path="/api/transactions",
     *     @OA\Response(
     *      response="200",
     *      description="List transactions"
     *     )
     * )
     */
    $this->app->get('/api/transactions', function(Request $request, Response $response, array $args): Response {
      return TransactionsController::get($request, $response, $args);
    });

    /**
     * @OA\Post(
     *     path="/api/transactions",
     *     @OA\Response(
     *      response="200",
     *      description="Create transaction"
     *     )
     * )
     */
    $this->app->post('/api/transactions', function(Request $request, Response $response, array $args): Response {
      return TransactionsController::post($request, $response, $args);
    });

    /**
     * @OA\Put(
     *     path="/api/transactions",
     *     @OA\Response(
     *      response="200",
     *      description="Update transaction"
     *     )
     * )
     */
    $this->app->put('/api/transactions', function(Request $request, Response $response, array $args): Response {
      return TransactionsController::put($request, $response, $args);
    });

    /**
     * @OA\Delete(
     *     path="/api/transactions",
     *     @OA\Response(
     *      response="200",
     *      description="Delete transaction"
     *     )
     * )
     */
    $this->app->delete('/api/transactions', function(Request $request, Response $response, array $args): Response {
      return TransactionsController::delete($request, $response, $args);
    });
  }
}
