<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Customer as Model;

class Customer extends Api
{
    /**
     * List customers.
     *
     * @return mixed
     */
    public function list()
    {
        $response = $this->client->get('customers');

        return collect($response->customers)->transform(function ($customer) {
            return new Model($customer, $this->client);
        });
    }

    /**
     * Find a customer.
     *
     * @param  string $email
     * @return Model
     */
    public function find($email)
    {
        $response = $this->client->get("customers/$email");

        return new Model($response->customer, $this->client);
    }
}
