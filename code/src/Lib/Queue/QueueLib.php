<?php

namespace SlimExample\Lib\Queue;
use SlimExample\Lib\DotEnv\DotEnvLib;

class QueueLib {
    public static function getQueueManager($managerName = null){
        $queueManager = null;
        if ($managerName === null) {
            $managerClass = "SlimExample\\Lib\\Queue\\Implementations\\".DotEnvLib::get('QUEUE_ENGINE');
            $queueManager = new $managerClass();
            
        } else {
            $managerClass = "SlimExample\\Lib\\Queue\\Implementations\\".$managerName;
            $queueManager = new $managerClass();
        }

        return $queueManager;
    }
}