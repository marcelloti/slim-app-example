<?php
namespace SlimExample\Acl\Infra\Orm;

use SlimExample\Acl\Infra\Orm\Implementations\Eloquent\Repository as EloquentRepository;

class Repository extends EloquentRepository {
    protected $model;

    public function __construct($model){
        $this->model = $model;
    }
}