<?php

namespace Tests\Unit\Acl\Infra\Queue;

use Tests\BaseTestCase;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;

class PhpDotEnvTest extends BaseTestCase
{
    public function testGetEnv()
    {
        $appName = DotEnvLib::get('APP_NAME');
        $this->assertEquals("SlimExample", $appName);
    }
}