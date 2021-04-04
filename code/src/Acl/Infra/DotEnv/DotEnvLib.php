<?php

namespace SlimExample\Acl\Infra\DotEnv;
use SlimExample\Acl\Infra\DotEnv\EnvEnum;

class DotEnvLib {
    protected static $defaultImplementation = '\SlimExample\Acl\Infra\DotEnv\Implementations\SymfonyDotEnv';

    private static $implementation = null;

    private function __construct() { }

    private function __clone() { }

    public static function get(string $envVar, string $env = EnvEnum::DEFAULT, string $implementation = null): string {
        if (!EnvEnum::envInList($env)){
            throw new \Exception("Unrecognized value of Env: ".$env);
        }
        
        if (!isset(self::$implementation)) {
            if (!$implementation){
                $implementation = new DotEnvLib::$defaultImplementation();
            } else {
                $implementation = new $implementation;
            }
            
            self::$implementation = $implementation;
        }

        return self::$implementation->get($envVar, $env);
    }
}