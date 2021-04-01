<?php
namespace SlimExample\Modules\Core\Subscribers;

use SlimExample\Acl\Infra\Queue\QueueLib;
use SlimExample\Modules\Core\Subscribers\ISubscriber;
use PhpAmqpLib\Message\AMQPMessage;

class TestSubscriber implements ISubscriber {
    public function execute(): void {
        ini_set('max_execution_time', 0);

        $qM = QueueLib::getQueueManager();
        $retorno = $qM->processQueue('QUEUE_TEST', function(AMQPMessage $queuemsg){
            $dados = json_decode($queuemsg->getBody(), false);

            if (
                $dados->userName == 'John Doe' &&
                $dados->email == 'johndoe@teste.com' &&
                $dados->password == '123'){
                file_put_contents($dados->filename, "true");
            } else {
                file_put_contents($dados->filename, "false");
            }
        });
    }
}