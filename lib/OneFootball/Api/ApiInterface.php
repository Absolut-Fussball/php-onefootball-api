<?php

namespace OneFootball\Api;

use OneFootball\Client;

/**
 * Api interface
 */
interface ApiInterface
{
    public function __construct(Client $client);
}
