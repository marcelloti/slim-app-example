<?php
namespace SlimExample\Modules\Authentication\Services;
use SlimExample\Acl\Domain\UsersAcl;

class LoginService {
    public static function login(string $email, string $senha): object {
        $findData = [
            ['email', '=', $email,],
            ['senha', '=', $senha]
        ];

        $dados = UsersAcl::findUsers($findData);

        print_r($dados);
        die();
        return $dados;
    }
}