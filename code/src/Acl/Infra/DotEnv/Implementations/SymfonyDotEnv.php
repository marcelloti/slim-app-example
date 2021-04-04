<?php
namespace SlimExample\Acl\Infra\DotEnv\Implementations;
use SlimExample\Acl\Infra\DotEnv\IDotEnv;

use SlimExample\Acl\Infra\DotEnv\EnvEnum;

class SymfonyDotEnv implements IDotEnv {
    public function get(string $envVar, string $env = EnvEnum::DEFAULT): string {
        $envFileName = $env === 'default' ? '.env' : '.env.'.$env;
        $envFilePath = __DIR__."/../../../../../".$envFileName;

        if (!file_exists($envFilePath)){
            throw new \Exception("Could not load env file: ".$envFilePath);
        }

        $dotenv = new \Symfony\Component\Dotenv\Dotenv();
        $dotenv->overload($envFilePath);     

        if (isset($_ENV[$envVar])){
            return $_ENV[$envVar];
        }
        return null;
    }
}