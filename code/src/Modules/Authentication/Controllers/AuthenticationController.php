<?php

namespace SlimExample\Modules\Authentication\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimExample\Modules\Core\Controllers\ControllerAbstract;

class AuthenticationController extends ControllerAbstract {
    public static function login(Request $request, Response $response, array $args): Response {
        return $response->withJson('Login Route');
    }
}