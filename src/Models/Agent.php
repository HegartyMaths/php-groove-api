<?php

namespace Groove\Models;

use Groove\Model;

class Agent extends Model
{
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
