<?php

namespace Tests\Functional;

class UsersEndpointTest extends BaseTestCase
{

    public function testGetUsersWithoutToken()
    {
        $response = $this->runApp('GET', '/v1/users');

        $this->assertEquals(401, $response->getStatusCode());
    }
}