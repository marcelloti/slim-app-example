<?php

namespace SlimExample\Modules\Users\Repositories;
use SlimExample\Acl\Infra\Orm\Repository;
use SlimExample\Modules\Users\Models\User;

class UsersRepository extends Repository {
    private $model;

    public function __construct(){
        parent::__construct(new User());
    }
}