<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Agent as Model;

class Agent extends Api
{
    /**
     * List agents.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     */
    public function list($params = [])
    {
        $response = $this->client->get('agents', $params);

        return collect($response->agents)->transform(function ($agent) {
            return new Model($agent, $this->client);
        });
    }

    /**
     * Find agent.
     *
     * @param  string $email
     * @return Model
     */
    public function find($email)
    {
        $response = $this->client->get("agents/$email");

        return new Model($response->agent, $this->client);
    }
}
