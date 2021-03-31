<?php

namespace Tests\Unit\Lib\Queue;

use Tests\BaseTestCase;
use SlimExample\Lib\DotEnv\DotEnvLib;
use Illuminate\Support\Facades\Http;

class UsersTest extends BaseTestCase
{
    public function testLoginUser()
    {
        $client = new \GuzzleHttp\Client();

        $res = $client->request(
            'POST',
            'http://localhost/api/login',
            [
                'json' => ['email' => 'test@test.com', 'senha' => 123]
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