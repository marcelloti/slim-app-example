<?php
namespace SlimExample\Acl\Infra\Queue\Implementations;
use SlimExample\Acl\Infra\Queue\IQueue;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

class RabbitMQ implements IQueue {
    private $connection;
    private $channel;

    protected $passive = false;
    protected $durable = false;
    protected $exclusive = false;
    protected $auto_delete = false;
    protected $nowait = false;
    protected $arguments = array();
    protected $ticket = null;
    protected $exchangeName = '';

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
            


            $this->channel->queue_declare(
                $queueName,
                $this->passive,
                $this->passive,
                $this->exclusive,
                $this->auto_delete,
                $this->nowait,
                $this->arguments,
                $this->ticket
            );

            $msg = new AMQPMessage(
                $data,
                array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            );

            $retorno = $this->channel->basic_publish($msg, $this->exchangeName, $queueName);

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

            $this->channel->queue_declare(
                $queueName,
                $this->passive,
                $this->passive,
                $this->exclusive,
                $this->auto_delete,
                $this->nowait,
                $this->arguments,
                $this->ticket
            );

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
            $errors[] = $err;
        } finally {
            try {
                $this->disconnect();
            }
            catch(\Exception $e){
                $errors[] = $e;
            }

            if (count($errors) > 0) {
                throw new \Exception(json_encode($errors));
            }
        }
    }
}