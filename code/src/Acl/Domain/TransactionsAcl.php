<?php

namespace SlimExample\Acl\Domain;
use SlimExample\Modules\Transactions\Repositories\TransactionsRepository;
use SlimExample\Acl\Infra\Queue\QueueLib;

class TransactionsAcl {
    protected static function consultaServicoExterno(string $url): bool {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);

        if(!$result){
            $httpcode = 0;
        }
        else {
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }

        if ($httpcode === 200){
            return true;
        } else {
            return false;
        }   
    }

    protected function consultaServicoNotificacaoExterno(): bool {
        return TransactionsAcl::consultaServicoExterno('https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');
    }

    protected function consultaServicoAutorizadorExterno(): bool {
        return TransactionsAcl::consultaServicoExterno('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
    }

    public static function scheduleTransaction(array $transactionData): void {
        $qM = QueueLib::getQueueManager();
        $qM->scheduleTask('QUEUE_TRANSACTIONS', json_encode($transactionData));
    }

    public static function registerTransactionInDatabase(array $newData): bool {
        try{
            $transactionsRepo = new TransactionsRepository();

            $dateNow = new \DateTime();
            
            $dataToInsert = [
                [
                    'value' => $newData['value'],
                    'payer' => $newData['payer'],
                    'payee' => $newData['payee'],
                    'created_at' => $dateNow->format('Y-m-d H:i:s'),
                    'updated_at'=> $dateNow->format('Y-m-d H:i:s')
                ],
            ];

            $transactionsRepo->insert($dataToInsert);

            $autorizado = TransactionsAcl::consultaServicoAutorizadorExterno();
            if (!$autorizado){
                return false;
            }
            
            TransactionsAcl::enviarNotificacao();
            return true;
        } catch (\Exception $e){
            return false;
        }
    }

    public static function registerRollbackTransactionInDatabase(array $newData): void {
        $transactionsRepo = new TransactionsRepository();

        $dateNow = new \DateTime();
        
        $dataToInsert = [
            [
                'value' => $newData['value'],
                'payer' => $newData['payee'], // Inversão payer X payee: Transação de Rollback
                'payee' => $newData['payer'],
                'created_at' => $dateNow->format('Y-m-d H:i:s'),
                'updated_at'=> $dateNow->format('Y-m-d H:i:s')
            ],
        ];

        $transactionsRepo->insert($dataToInsert);

        TransactionsAcl::enviarNotificacao();
    }

    public static function enviarNotificacao(): bool {
        $notificado = TransactionsAcl::consultaServicoNotificacaoExterno();
        if (!$notificado){
            return false;
        }
        
        return true;
    }
}