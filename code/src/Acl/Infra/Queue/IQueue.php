<?php

namespace SlimExample\Acl\Infra\Queue;

interface IQueue {
    public function scheduleTask(string $queueName, string $data): void;
    public function processQueue(string $queueName, callable $callback): void;
}