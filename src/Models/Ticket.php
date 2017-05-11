<?php

namespace Groove\Models;

use Groove\Model;
use Groove\Api\Customer;

class Ticket extends Model
{
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
