<?php
namespace SlimExample\Modules\Core\Repositories;
use SlimExample\Acl\Infra\Orm\Repository;
use SlimExample\Modules\Core\Models\Test;

class TestsRepository extends Repository {
    public function __construct($model = null){
        parent::__construct($model === null ? new Test() : $model);
    }
}