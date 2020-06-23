<?php

namespace OneFootball;

use GuzzleHttp\RequestOptions;
use OneFootball\Api\AbstractApi;
use OneFootball\Exception\ErrorException;
use OneFootball\Exception\InvalidArgumentException;
use GuzzleHttp\Client as HttpClient;

/**
 * Simple API wrapper for OneFootball
 *
 * @author Christian Wiedemann <christian.wiedemann@key-tec.de>
 *
 */
class Client
{

    private $url;
    private $token;

    /**
     * Instantiate a new OneFootball client
     *
     * @param $url
     * @param \GuzzleHttp\Client $httpClient ;
     */
    public function __construct($url, HttpClient $httpClient)
    {
        $this->url = $url;
        $this->httpClient = $httpClient;
    }

    /**
     * @return Api\Post
     */
    public function post()
    {
        return new Api\Post($this);
    }

    /**
     * @param string $name
     *
     * @return AbstractApi|mixed
     * @throws InvalidArgumentException
     */
    public function api($name)
    {
        switch ($name) {
            case 'post':
                return $this->post();

            default:
                throw new InvalidArgumentException(
                  'Invalid endpoint: "' . $name . '"'
                );
        }
    }

    /**
     * Authenticate a user for all next requests
     *
     * @param string $emailAddress OneFootball email
     * @param string $password OneFootball password
     *
     * @return $this
     */
    public function authenticate($emailAddress, $password)
    {
        $response = $this->getHttpClient()->post(
          $this->url . '/v1/login',
          [
            RequestOptions::JSON => [
              "login" => $emailAddress,
              "password" => $password,
            ],
          ]
        );
        $jsonResult = (string)$response->getBody();
        $result = json_decode($jsonResult);
        $this->token = $result->access_token;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getToken() {
        return $this->token;
    }

    /**
     * @param string $api
     *
     * @return AbstractApi
     */
    public function __get($api)
    {
        return $this->api($api);
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }


}
