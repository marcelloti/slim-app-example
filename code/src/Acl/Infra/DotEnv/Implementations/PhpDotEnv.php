<?php
namespace SlimExample\Acl\Infra\DotEnv\Implementations;
use SlimExample\Acl\Infra\DotEnv\IDotEnv;

class PhpDotEnv implements IDotEnv {
    public function get(string $envVar): string {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__."/../../../../../");
        $dotenv->load();
        if (isset($_ENV[$envVar])){
            return $_ENV[$envVar];
        }
        return null;
    }
}