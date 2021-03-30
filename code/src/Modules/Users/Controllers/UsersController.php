<?php

namespace SlimExample\Modules\Users\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimExample\Modules\Core\Controllers\ControllerAbstract;
use SlimExample\Modules\Users\Models\User;

class UsersController extends ControllerAbstract {
    public static function get(Request $request, Response $response, array $args): Response {
        $users = User::get();
        return $response->withJson($users);
    }

    public static function post(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $user = User::create($data);
        return $response->withJson($user);
    }

    public static function put(Request $request, Response $response, array $args): Response {
        return $response->withJson('Put Users');
    }

    public static function delete(Request $request, Response $response, array $args): Response {
        return $response->withJson('Delete Users');
    }
}