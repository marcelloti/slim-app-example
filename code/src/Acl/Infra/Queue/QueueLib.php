<?php

namespace SlimExample\Acl\Infra\Queue;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

class QueueLib {
    public static function getQueueManager($managerName = null){
        $queueManager = null;
        if ($managerName === null) {
            $managerClass = "SlimExample\\Acl\\Infra\\Queue\\Implementations\\".DotEnvLib::get('QUEUE_ENGINE');
            $queueManager = new $managerClass();            
        } else {
            $managerClass = "SlimExample\\Acl\\Infra\\Queue\\Implementations\\".$managerName;
            $queueManager = new $managerClass();
        }

        return $queueManager;
    }
}