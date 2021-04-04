<?php

namespace SlimExample\Acl\Infra\Orm\Implementations\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use SlimExample\Acl\Infra\Orm\IRepository;

class Repository implements IRepository {
    public function findAll(): array {
        return $this->model::get()->toArray();
    }

    public function findBy(array $data): array {
        $tableName = $this->model->getTable();
        $dataFetched = $this->model->where($data)->get();

        return $dataFetched->toArray();
    }

    public function insert(array $data): void {
        $this->model::insert($data);
    }

    public function delete(array $data): void {
        $tableName = $this->model->getTable();
        $this->model->where($data)->delete();
    }

    public function update(array $filter, array $newData): void {
        $this->model::where($filter)->update($newData);
    }
}