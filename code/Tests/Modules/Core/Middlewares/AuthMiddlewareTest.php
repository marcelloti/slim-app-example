<?php

namespace Tests\Functional;

use Tests\RequestTestCase;

class AuthMiddlewareTest extends RequestTestCase
{
    protected function makeRequestAndReturnHttpCode(string $rota, string $verbo = "GET", array $dados = []): int {
        $ch = curl_init('http://localhost/'.$rota);

        if ($verbo === "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen(json_encode($dados)))                                                                       
            );
        }

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);

        if(!$result){
            $httpcode = 0;
        }
        else {
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        }

        return $httpcode;
    }

    public function testUnauthorizedRoute()
    {
        $httpcode = $this->makeRequestAndReturnHttpCode('api/users');

        $this->assertEquals(401, $httpcode);
    }

    public function testAuthorizedRoute()
    {
        $loginData = [
            "email" => "lojista1@exampleapp.com",
            "senha" => "123"
        ];

        $httpcode = $this->makeRequestAndReturnHttpCode('api/login', "POST", $loginData);

        $this->assertEquals(200, $httpcode);
    }
}
