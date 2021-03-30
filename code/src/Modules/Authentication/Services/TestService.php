<?php
namespace SlimExample\Modules\Authentication\Services;

use SlimExample\Lib\Queue\QueueLib;
use SlimExample\Modules\Core\Service\IService;
use PhpAmqpLib\Message\AMQPMessage;

class TestService implements IService {
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