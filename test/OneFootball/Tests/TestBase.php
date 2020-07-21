<?php

namespace OneFootball\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use OneFootball\Client;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;


abstract class TestBase extends TestCase
{

    protected $mockHttpClient;

    private $mock = false;

    private $url;

    protected function getMockHandlerStack($responses = [])
    {
        $mock = new MockHandler(
          array_merge(
            [
              new Response(
                200,
                [],
                '{"access_token":"hKVksyTYSh-fPAAT9fjokQ"}'
              ),
            ],
            $responses
          )
        );
        $handlerStack = HandlerStack::create($mock);
        return $handlerStack;
    }

    public function setUp()
    {
        $this->url = 'https://network-api.onefootball.com';
    }

    protected function getHttpClient($responses = [])
    {
        $handlerStack = $this->getMockHandlerStack($responses);
        if ($this->mock === true) {
            return new GuzzleClient(['handler' => $handlerStack]);
        }
        return new GuzzleClient();
    }

    protected function authenticate($httpClient)
    {
        $client = new Client($this->url, $httpClient);
        $client->authenticate(
          'example@example.com',
          'password'
        );
        return $client;
    }
}
