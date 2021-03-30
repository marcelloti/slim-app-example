<?php
namespace SlimExample\Lib\Queue\Implementations;
use SlimExample\Lib\Queue\IQueue;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use SlimExample\Lib\DotEnv\DotEnvLib;

class RabbitMQ implements IQueue {
    private $connection;
    private $channel;

    private function initConnection(): void {
        $queueHost = DotEnvLib::get('QUEUE_HOST');
        $queuePort = DotEnvLib::get('QUEUE_PORT');
        $queueUser = DotEnvLib::get('QUEUE_USER');
        $queuePassword = DotEnvLib::get('QUEUE_PASSWORD');

        $this->connection = new AMQPStreamConnection(
            $queueHost,
            intval($queuePort),
            $queueUser,
            $queuePassword
        );

        $this->channel = $this->connection->channel();
    }

    private function disconnect(){
        $this->channel->close();
        $this->connection->close();
    }

    public function scheduleTask(string $queueName, string $data): void {
        $errors = [];

        try{
            $connection = $this->initConnection();
            
            $passive = false;
            $durable = false;
            $exclusive = false;
            $auto_delete = false;
            $nowait = false;
            $arguments = array();
            $ticket = null;
            $exchangeName = '';

            $this->channel->queue_declare(
                $queueName,
                $passive,
                $durable,
                $exclusive,
                $auto_delete,
                $nowait,
                $arguments,
                $ticket
            );

            $msg = new AMQPMessage(
                $data,
                array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            );

            $retorno = $this->channel->basic_publish($msg, $exchangeName, $queueName);

            $this->channel->basic_qos(
                null, #prefetch size - prefetch window size in octets, null meaning "no specific limit"
                1,    #prefetch count - prefetch window in terms of whole messages
                null  #global - global=null to mean that the QoS settings should apply per-consumer, global=true to mean that the QoS settings should apply per-channel
            );
        }
        catch (\Exception $error) {
            $errors[] = $error;
        }
        finally {
            try {
                $this->disconnect();
            }
            catch(\Exception $err) {
                $errors[] = $err;
            }

            if (count($errors) > 0) {
                throw new \Exception($errors);
            }
        }
    }

    public function processQueue(string $queueName, callable $callback): void {
        $errors = [];
       
        try{
            $connection = $this->initConnection();
            $consumerTag = "";

            $this->channel->basic_consume(
                $queueName,
                $consumerTag,
                false,
                true,
                false,
                false,
                function ($msg) use ($callback) {
                    $callback($msg);
                }
            );

            while ($this->channel->is_consuming()) {
                $this->channel->wait();
            }
        } catch (\Exception $err) {
            $errors[] = $error;
        } finally {
            try {
                $this->disconnect();
            }
            catch(\Exception $e){
                $errors[] = $e;
            }

            if (count($errors) > 0) {
                throw new \Exception($errors);
            }
        }
    }
}