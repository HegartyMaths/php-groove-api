<?php

namespace Groove;

abstract class Api
{
    /**
     * @var \Groove\Client
     */
    protected $client;

    /**
     * Api.
     *
     * @param \Groove\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}
