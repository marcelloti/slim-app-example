<?php
namespace SlimExample\Lib\DotEnv\Implementations;
use SlimExample\Lib\DotEnv\IDotEnv;

class PhpDotEnv implements IDotEnv {
    public function get(string $envVar): string {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../../../");
        $dotenv->load();
        if (isset($_ENV[$envVar])){
            return $_ENV[$envVar];
        }
        return null;
    }
}