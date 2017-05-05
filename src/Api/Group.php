<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Group as Model;

class Group extends Api
{
    /**
     * List groups.
     *
     * @return $this
     */
    public function list()
    {
        $response = $this->client->get('groups');

        return collect($response->groups)->transform(function ($group) {
            return new Model($group, $this->client);
        });
    }
}
