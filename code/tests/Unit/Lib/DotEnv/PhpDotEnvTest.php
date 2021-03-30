<?php

namespace Tests\Unit\Lib\Queue;

use Tests\BaseTestCase;
use SlimExample\Lib\DotEnv\DotEnvLib;

class PhpDotEnvTest extends BaseTestCase
{
    public function testGetEnv()
    {
        $appName = DotEnvLib::get('APP_NAME');
        $this->assertEquals("SlimExample", $appName);
    }
}