<?php

namespace Tests\Acl\Infra\Orm;

use PHPUnit\Framework\TestCase;
use SlimExample\Acl\Infra\Orm\Repository;

use SlimExample\Acl\Infra\TokenGenerator\TokenGeneratorLib;

class TokenGeneratorLibTest extends TestCase
{
    public function testGenerateToken(): void
    {
        $userId = 1;
        $secret = "SeC_".substr(uniqid(), 0, 6)."_#";

        $token = TokenGeneratorLib::generate($userId, $secret);

        $this->assertNotNull( 
            $token, 
            "variable is null"
        );
    }
}