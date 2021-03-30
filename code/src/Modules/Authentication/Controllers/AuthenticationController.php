<?php

namespace SlimExample\Modules\Authentication\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthenticationController {
    public static function login(Request $request, Response $response, array $args): Response {
        return $response->withJson('Login Route');
    }
}