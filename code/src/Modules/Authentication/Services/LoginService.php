<?php
namespace SlimExample\Modules\Authentication\Services;

class LoginService {
    public static function login(string $username, string $password): object {
        $dados=new \stdClass();
        $dados->token = null;
        return $dados;
    }
}