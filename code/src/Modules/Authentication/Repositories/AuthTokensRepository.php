<?php
namespace SlimExample\Modules\Authentication\Repositories;
use SlimExample\Acl\Infra\Orm\Repository;
use SlimExample\Modules\Authentication\Models\AuthToken;

class AuthTokensRepository extends Repository {
    public function __construct($model = null){
        parent::__construct($model === null ? new AuthToken() : $model);
    }
}