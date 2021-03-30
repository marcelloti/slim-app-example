<?php

namespace Tests\Unit\Lib\Queue;

use PHPUnit\Framework\TestCase;
use SlimExample\Lib\Queue\QueueLib;

class QueueTest extends TestCase
{
    public function testGetQueueManagerFromClass()
    {
        $qM = QueueLib::getQueueManager('RabbitMQ');
        $this->assertEquals("SlimExample\\Lib\\Queue\\Implementations\\RabbitMQ", get_class($qM));
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

        while(!file_exists($dados->filename));

        $processQueueResult = file_get_contents($dados->filename);
        unlink($dados->filename);

        $this->assertEquals($processQueueResult, "true");
    }
}