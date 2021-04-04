<?php

namespace Tests\Unit\Acl\Infra\Queue;

use Tests\RequestTestCase;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;
use Illuminate\Support\Facades\Http;

class UsersTest extends RequestTestCase
{
    public function testLoginUser()
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->request(
            'POST',
            'http://localhost/api/login',
            [
                'json' => ['email' => 'usuario1@exampleapp.com', 'senha' => 123]
            ]
        );

        $authData = $res->getBody()->getContents();

        $authDataParsed = json_decode($authData, true);
        
        if ($authDataParsed === NULL || !isset($authDataParsed['token'])){
            throw new \Exception("Impossível logar usuário");
        }
       
        $this->assertNotNull( 
            $authDataParsed['token'], 
            "variable is null"
        );
    }
}