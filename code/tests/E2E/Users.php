<?php

namespace Tests\Unit\Lib\Queue;

use Tests\BaseTestCase;
use SlimExample\Lib\DotEnv\DotEnvLib;
use Illuminate\Support\Facades\Http;

class UsersTest extends BaseTestCase
{
    public function testCreateUser()
    {
        $authToken = Http::withBasicAuth('johndoe@teste.com', '123')
        ->post('http://localhost/api/login');
    }
}