<?php

namespace App\Library\D4Sign;

class Service
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
