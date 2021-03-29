<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    public function testGetApiOnlineResponse()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('API ONLINE', (string)$response->getBody());
    }
}
