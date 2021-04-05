<?php

namespace Tests\Unit\Acl\Infra\Queue;

use Tests\RequestTestCase;
use SlimExample\Acl\Infra\DotEnv\DotEnvLib;
use Illuminate\Support\Facades\Http;
use SlimExample\Modules\Authentication\Services\LoginService;
use Ramsey\Uuid\Uuid;

class TransactionsTest extends RequestTestCase
{
    public function testRegisterTransaction(): void
    {
        $client = new \GuzzleHttp\Client();

        $authToken = LoginService::getNewAuthToken('usuario2@exampleapp.com', '123');

        $res = $client->request(
            'POST',
            'http://localhost/api/transactions',
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$authToken
                ],
                'json' => [
                    'value' => 100.00,
                    'payer' => Uuid::uuid4()->toString(),
                    'payee' => Uuid::uuid4()->toString()
                ]
            ]
        );

        $responseCode = $res->getStatusCode();

        $this->assertEquals(200, $responseCode);
    }
}