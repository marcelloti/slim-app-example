<?php

namespace SlimExample\Lib\Queue;

interface IQueue {
    public function scheduleTask(string $queueName, string $data): void;
    public function processQueue(string $queueName, callable $callback): void;
}