<?php

namespace Tests\Unit\Acl\Infra\Queue;

use PHPUnit\Framework\TestCase;
use SlimExample\Modules\Authentication\Services\LoginService;

class LoginServiceTest extends TestCase
{
    public function testGetNewAuthToken()
    {
        $email = "usuario1@exampleapp.com";
        $senha = "123";
        $token = LoginService::getNewAuthToken($email, $senha);

        $this->assertNotNull( 
            $token, 
            "variable is null"
        );
    }
}