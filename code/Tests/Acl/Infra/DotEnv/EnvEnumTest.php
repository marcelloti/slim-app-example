<?php

namespace Tests\Acl\Infra\DotEnv;
use SlimExample\Acl\Infra\DotEnv\EnvEnum;
use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

class EnvEnumTest extends TestCase
{
    public function testCheckDefaultEnvInList(): void
    {
        $retornoDefault = EnvEnum::envInList(EnvEnum::DEFAULT);

        $this->assertEquals(true, $retornoDefault);
    }

    public function testCheckNonExistentEnvInList(): void
    {
        $retornoDefault = EnvEnum::envInList('NotExist');

        $this->assertEquals(false, $retornoDefault);
    }
}