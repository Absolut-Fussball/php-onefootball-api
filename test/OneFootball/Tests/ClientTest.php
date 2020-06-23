<?php

namespace OneFootball\Tests;

class ClientTest extends TestBase
{
    public function testAuthenticate()
    {
        $token = $this->authenticate($this->getHttpClient())->getToken();
        $this->assertIsString($token);
    }
}
