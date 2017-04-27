<?php

namespace Groove\Models;

use Groove\Model;

class Agent extends Model
{
    /**
     * @var
     */
    protected $details;

    /**
     * @var \Groove\Client
     */
    protected $client;

    /**
     * Agent.
     *
     * @param $details
     * @param \Groove\Client $client
     */
    public function __construct($details, $client)
    {
        $this->details = $details;
        $this->client = $client;
    }

    /**
     * Agent groups.
     *
     * @return mixed
     */
    public function groups()
    {
        return collect($this->client->get($this->details->links->groups->href));
    }

    /**
     * Agent tickets.
     *
     * @return mixed
     */
    public function tickets()
    {
        return collect($this->client->get($this->details->links->tickets->href));
    }
}
