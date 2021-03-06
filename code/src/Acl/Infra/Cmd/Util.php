<?php

namespace SlimExample\Acl\Infra\Cmd;

class Util {
    public static function getCurrentEnv(): string {
        $env = 'default';

        if (isset($_ENV)){
            if (isset($_ENV['ENV']) && $_ENV['ENV'] !== NULL){
                $env = $_ENV['ENV'];
            }
        }

        // Current Phinx / Cmd Env (from https://github.com/cakephp/phinx/issues/1137)
        if (isset($_SERVER['argv']) && isset($_SERVER['argv'][3])){
            $env = $_SERVER['argv'][3];
        }

        return $env;
    }
}