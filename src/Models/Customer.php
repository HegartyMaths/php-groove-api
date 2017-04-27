<?php

namespace Groove\Models;

use Groove\Model;

class Customer extends Model
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
     * Customer.
     *
     * @param $details
     * @param \Groove\Client $client
     */
    public function __construct($details, $client)
    {
        $this->details = $details;
        $this->client = $client;
    }
}
