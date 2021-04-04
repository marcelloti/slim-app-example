<?php
namespace SlimExample\Acl\Infra\DotEnv;

class EnvEnum
{
    const DEFAULT = 'default';
    const TESTING = 'testing';

    public static function envInList(string $value): bool {
        $RC = new \ReflectionClass('SlimExample\Acl\Infra\DotEnv\EnvEnum');
        $enumValues = $RC->getConstants();

        return in_array($value, $enumValues);
    }
}