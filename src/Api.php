<?php

namespace Groove;

abstract class Api
{
    /**
     * @var \Groove\Client
     */
    protected $client;

    /**
     * ApiAbstract constructor.
     *
     * @param \Groove\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }
}
