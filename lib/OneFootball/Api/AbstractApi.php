<?php

namespace OneFootball\Api;

use GuzzleHttp\RequestOptions;
use Http\Message\StreamFactory;
use OneFootball\Client;
use OneFootball\QueryStringBuilder;
use Psr\Http\Message\StreamInterface;

/**
 * Abstract class for Api classes
 *
 * @author Christian Wiedemann
 */
abstract class AbstractApi implements ApiInterface
{

    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * @var StreamFactory
     */
    private $streamFactory;

    /**
     * @param \OneFootball\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    private function preparePath($path, array $parameters = [])
    {
        if (count($parameters) > 0) {
            $path .= '?' . QueryStringBuilder::build($parameters);
        }

        return $path;
    }

    /**
     * @param array $parameters
     *
     * @return StreamInterface
     */
    private function prepareBody(array $parameters = [])
    {
        $raw = QueryStringBuilder::build($parameters);
        $stream = $this->streamFactory->createStream($raw);

        return $stream;
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param array $requestHeaders
     *
     * @return mixed
     */
    protected function get($path, array $parameters = [], $requestHeaders = [])
    {
        $headers = [
          'Authorization' => 'Bearer ' . $this->client->getToken(),
        ];
        $path = $this->preparePath($path, $parameters);
        $response = $this->client->getHttpClient()->request('GET', $path,          [
          RequestOptions::HEADERS => $headers
        ]);
        $jsonResult = (string)$response->getBody();
        return json_decode($jsonResult);
    }

    /**
     * @param string $path
     * @param array $parameters
     *
     * @return mixed
     */
    protected function put(
      $path,
      array $parameters = []
    ) {
        $headers = [
          'Authorization' => 'Bearer ' . $this->client->getToken(),
        ];
        $response = $this->client->getHttpClient()->put(
          $path,
          [
            RequestOptions::HEADERS => $headers,
            RequestOptions::JSON => $parameters,
          ]
        );
        $jsonResult = (string)$response->getBody();
        return json_decode($jsonResult);
    }

    /**
     * @param string $path
     * @param array $parameters
     *
     * @return mixed
     */
    protected function post(
      $path,
      array $parameters = []
    ) {
        $headers = [
          'Authorization' => 'Bearer ' . $this->client->getToken(),
        ];
        $response = $this->client->getHttpClient()->post(
          $path,
          [
            RequestOptions::HEADERS => $headers,
            RequestOptions::JSON => $parameters,
          ]
        );
        $jsonResult = (string)$response->getBody();
        return json_decode($jsonResult);
    }
}
