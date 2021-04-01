<?php

namespace SlimExample\Acl\Infra\Orm\Implementations\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use SlimExample\Acl\Infra\Orm\IRepository;

class Repository implements IRepository {
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function findAll(): array {
        return [];
    }

    public function findBy(array $data): Array {
        $tableName = $this->model->getTable();
        $dataFetched = $this->model->where($data)->get()->toArray();

        return $data;

    }

    public function insert(array $data): bool{
        return false;
    }

    public function delete(array $data): bool{
        return false;
    }

    public function update(){
        
    }
}