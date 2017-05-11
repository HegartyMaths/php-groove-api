<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Customer as Model;

class Customer extends Api
{
    /**
     * List customers.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     */
    public function list($params = [])
    {
        $response = $this->client->get('customers', $params);

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

    /**
     * Update a customer.
     *
     * @param  string $existingEmail
     * @param  string $updatedEmail
     * @param  array $params
     * @return Model
     */
    public function update($existingEmail, $updatedEmail, $params = [])
    {
        $params = array_merge(['email' => $updatedEmail], $params);

        $response = $this->client->put("customers/$existingEmail", $params);

        return new Model($response->customer, $this->client);
    }
}
