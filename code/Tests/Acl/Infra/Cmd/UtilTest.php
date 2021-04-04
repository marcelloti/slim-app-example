<?php

namespace Tests\Acl\Infra\Cmd;

use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\Cmd\Util;

class UtilTest extends TestCase
{
    public function testGetCurrentEnv()
    {
        $currentEnv = Util::getCurrentEnv();
        $this->assertEquals('testing', $currentEnv);
    }
}