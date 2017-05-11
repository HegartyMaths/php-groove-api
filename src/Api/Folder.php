<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Folder as Model;

class Folder extends Api
{
    /**
     * List folders.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     */
    public function list($params = [])
    {
        $response = $this->client->get('folders', $params);

        return collect($response->folders)->map(function ($folder) {
            return new Model($folder, $this->client);
        });
    }
}
