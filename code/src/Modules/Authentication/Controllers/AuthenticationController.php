<?php

namespace SlimExample\Modules\Authentication\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimExample\Modules\Core\Controllers\ControllerAbstract;
use SlimExample\Modules\Authentication\Services\LoginService;

class AuthenticationController extends ControllerAbstract {
    public static function login(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        if (!isset($data['email']) || !isset($data['senha'])){
            return $response->withStatus(400)
            ->withJson(['error' => 'Dados da requisição inválidos']);
        }

        $token = LoginService::getNewAuthToken($data['email'], $data['senha']);

        return $response->withStatus(200)->withJson(
            ['token' => $token]    
        );
    }
}