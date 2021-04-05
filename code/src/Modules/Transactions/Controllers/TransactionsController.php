<?php

namespace SlimExample\Modules\Transactions\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimExample\Modules\Core\Controllers\ControllerAbstract;
use SlimExample\Modules\Transactions\Models\Transaction;
use SlimExample\Modules\Transactions\Services\TransactionService;
use Ramsey\Uuid\Uuid;

class TransactionsController extends ControllerAbstract {
    public static function get(Request $request, Response $response, array $args): Response {
        # TODO
        /*$transactions = Transaction::get();
        return $response->withJson($transactions);*/
        return $response->withJson('#TODO Get Transactions');
    }

    public static function post(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();

        if (!isset($data['value']) || !isset($data['payer']) || !isset($data['payee'])){
            return $response->withStatus(400)
            ->withJson(['error' => 'Dados da requisição inválidos']);
        }

        $value = floatval($data['value']);
        if ($value == 0){
            return $response->withStatus(400)
            ->withJson(['error' => 'This value is not valid!']);
        }

        if (!Uuid::isValid($data['payer'])) {
            return $response->withStatus(400)
            ->withJson(['error' => 'This payer is not valid!']);
        }
        if (!Uuid::isValid($data['payee'])) {
            return $response->withStatus(400)
            ->withJson(['error' => 'This payee is not valid!']);
        }

        $transactionData = array (
            'value' => $value,
            'payer' => $data['payer'],
            'payee' => $data['payee']
        );
        $retorno = TransactionService::scheduleTransaction($transactionData);

        if ($retorno){
            return $response->withStatus(200)
            ->withJson(['msg' => 'Transacao em andamento']);
        } else {
            return $response->withStatus(400)
            ->withJson(['error' => 'Impossivel completar a transacao']);
        }
    }

    public static function put(Request $request, Response $response, array $args): Response {
        # TODO
        return $response->withJson('#TODO Put Transactions');
    }

    public static function delete(Request $request, Response $response, array $args): Response {
        # TODO
        return $response->withJson('#TODO Delete Transactions');
    }
}