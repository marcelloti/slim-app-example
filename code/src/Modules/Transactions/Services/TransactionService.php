<?php
namespace SlimExample\Modules\Transactions\Services;
use SlimExample\Acl\Domain\TransactionsAcl;

use SlimExample\Modules\Transactions\Repositories\TransactionsRepository;
use SlimExample\Acl\Domain\UsersAcl;

class TransactionService {
    protected function usuarioEhLojista(string $payer): ?bool {
        $findData = [
            ['id', '=', $payer]
        ];

        $dadosConsulta = UsersAcl::findUsers($findData);

        if (count($dadosConsulta) === 0){
            return null;
        }

        return $dadosConsulta[0]['lojista'];
    }

    public function scheduleTransaction(array $data): bool {
        if (TransactionService::usuarioEhLojista($data['payer'])){
            return false;
        }

        TransactionsAcl::scheduleTransaction($data);

        return true;
    }
}