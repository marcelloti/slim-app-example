<?php
namespace SlimExample\Modules\Transactions\Subscribers;

use SlimExample\Acl\Infra\Queue\QueueLib;
use SlimExample\Modules\Core\Subscribers\ISubscriber;
use PhpAmqpLib\Message\AMQPMessage;
use SlimExample\Acl\Domain\TransactionsAcl;

class TransactionRegisterSubscriber implements ISubscriber {
    public function execute(): void {
        if (\SlimExample\Acl\Infra\Cmd\Util::getCurrentEnv() !== 'testing'){
            require_once(__DIR__."/../../../../bootstrap.php");
        } else {
            require_once(__DIR__."/../../../../Tests/BootstrapTests.php");
        }

        ini_set('max_execution_time', 0);

        $qM = QueueLib::getQueueManager();

        $retorno = $qM->processQueue('QUEUE_TRANSACTIONS', function(AMQPMessage $queuemsg){
            $dados = json_decode($queuemsg->getBody(), true);
            if ($dados === null){
                return;
            }

            $resultadoRegistro = TransactionsAcl::registerTransactionInDatabase($dados);

            if (!$resultadoRegistro){
                TransactionsAcl::registerRollbackTransactionInDatabase($dados);
            }
        });
    }
}