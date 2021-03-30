<?php

namespace SlimExample\Modules\Core\Subscribers;

interface ISubscriber {
    public function execute(): void;
}