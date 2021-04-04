<?php

namespace Tests\Functional;

use Tests\RequestTestCase;

class HomepageTest extends RequestTestCase
{
    public function testGetApiOnlineResponse()
    {
        $response = $this->request('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('API ONLINE', (string)$response->getBody());
    }
}
