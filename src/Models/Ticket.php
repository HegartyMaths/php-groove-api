<?php

namespace Groove\Models;

use Groove\Api\Customer;
use Groove\Model;

class Ticket extends Model
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
     * Ticket.
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
     * Ticket messages.
     *
     * @return \Illuminate\Support\Collection
     */
    public function messages()
    {
        $messages = $this->client->get("tickets/{$this->details->number}/messages");

        return collect($messages);
    }

    /**
     * Ticket customer.
     *
     * @return Customer
     */
    public function customer()
    {
        return (new Customer($this->client))->find($this->details->links->customer->id);
    }
}
