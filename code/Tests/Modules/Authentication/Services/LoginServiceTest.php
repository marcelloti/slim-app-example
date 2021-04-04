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

    public function testValidateAuthToken(){
        $email = "usuario1@exampleapp.com";
        $senha = "123";
        $token = LoginService::getNewAuthToken($email, $senha);

        $tokenIsValid = LoginService::validateAuthToken($token);

        $this->assertEquals(true, $tokenIsValid);
    }

    public function testValidateAuthTokenWithInvalidToken(){
        $email = "usuario1@exampleapp.com";
        $senha = "123";
        $token = LoginService::getNewAuthToken($email, $senha);

        $tokenIsValid = LoginService::validateAuthToken($token."123");

        $this->assertEquals(false, $tokenIsValid);
    }

    public function testGetAuthTokenDataInDatabaseByToken(){
        $email = "usuario1@exampleapp.com";
        $senha = "123";
        $token = LoginService::getNewAuthToken($email, $senha);

        $tokenRetornado = LoginService::getAuthTokenDataInDatabaseByToken($token);

        $this->assertNotNull( 
            $tokenRetornado, 
            "variable is null"
        );
    }
}