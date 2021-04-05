<?php
namespace SlimExample\Modules\Transactions\Repositories;
use SlimExample\Acl\Infra\Orm\Repository;
use SlimExample\Modules\Transactions\Models\Transaction;

class TransactionsRepository extends Repository {
    public function __construct($model = null){
        parent::__construct($model === null ? new Transaction() : $model);
    }
}