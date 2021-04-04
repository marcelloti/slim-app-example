<?php

namespace SlimExample\Modules\Users\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use SlimExample\Modules\Core\Controllers\ControllerAbstract;
use SlimExample\Modules\Users\Models\User;

class UsersController extends ControllerAbstract {
    public static function get(Request $request, Response $response, array $args): Response {
        # TODO
        /*$users = User::get();
        return $response->withJson($users);*/
        return $response->withJson('#TODO Get Users');
    }

    public static function post(Request $request, Response $response, array $args): Response {
        # TODO
        /*$data = $request->getParsedBody();
        $user = User::create($data);
        return $response->withJson($user);*/

        return $response->withJson('#TODO Post Users');
    }

    public static function put(Request $request, Response $response, array $args): Response {
        # TODO
        return $response->withJson('#TODO Put Users');
    }

    public static function delete(Request $request, Response $response, array $args): Response {
        # TODO
        return $response->withJson('#TODO Delete Users');
    }
}