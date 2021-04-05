<?php

namespace Tests\Acl\Infra\DotEnv;

use SlimExample\Acl\Infra\DotEnv\EnvEnum;
use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

class DotEnvLibTest extends TestCase
{
    public function testCheckDefaultEnv(): void
    {
        $appName = DotEnvLib::get('APP_NAME');
        $this->assertEquals("SlimExample", $appName);
    }

    public function testGetEnvWithTestingFile(): void
    {
        $appName = DotEnvLib::get('APP_NAME', EnvEnum::TESTING);
        $this->assertEquals("SlimExampleTesting", $appName);
    }
}