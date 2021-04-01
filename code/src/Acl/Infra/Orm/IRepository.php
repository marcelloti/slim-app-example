<?php

namespace SlimExample\Acl\Infra\Orm;

interface IRepository {
    public function findAll(): array;
    public function findBy(array $data): array;
    public function insert(array $data): bool;
    public function delete(array $data): bool;
}