<?php

namespace SlimExample\Acl\Domain;
use SlimExample\Modules\Users\Repositories\UsersRepository;

class UsersAcl {
    public static function findUsers(array $fields): array {
        $UsersRepo = new UsersRepository();
        $usuariosEncontrados = $UsersRepo->findBy($fields);

        return $usuariosEncontrados;
    }
}