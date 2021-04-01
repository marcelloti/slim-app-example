<?php

namespace SlimExample\Acl\Infra\DotEnv;

use SlimExample\Acl\Infra\DotEnv\Implementations\PhpDotEnv;

class DotEnvLib {
    private static $defaultImplementation = 'PhpDotEnv';

    private static $implementation = null;

    private function __construct() { }

    private function __clone() { }

    public static function get(string $envVar, string $implementation = null): string {
        if (!isset(self::$implementation)) {
            if (!$implementation){
                $implementation = new PhpDotEnv();
            } else {
                $implementation = new $implementation;
            }
            
            self::$implementation = $implementation;
        }      

        return self::$implementation->get($envVar);
    }
}