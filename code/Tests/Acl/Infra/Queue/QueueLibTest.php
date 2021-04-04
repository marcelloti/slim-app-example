<?php

namespace Tests\Acl\Infra\Queue;

use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\Queue\QueueLib;

class QueueLibTest extends TestCase
{
    public function testGetQueueManagerFromClass()
    {
        $qM = QueueLib::getQueueManager('RabbitMQ');
        $this->assertEquals("SlimExample\\Acl\Infra\\Queue\\Implementations\\RabbitMQ", get_class($qM));
    }

    public function testSendDataToQueue()
    {
        $dados=new \stdClass();
        $dados->userName = 'John Doe';
        $dados->email = 'johndoe@teste.com';
        $dados->password = '123';
        $dados->filename = 'TEST_QUEUE';

        $qM = QueueLib::getQueueManager();
        $retorno = $qM->scheduleTask('QUEUE_TEST', json_encode($dados));

        set_time_limit(10);
        while(!file_exists($dados->filename));

        $processQueueResult = file_get_contents($dados->filename);
        unlink($dados->filename);

        $this->assertEquals("true", "true");
    }
}