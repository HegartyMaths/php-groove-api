<?php

namespace Groove\Api;

use Groove\Api;

class Folder extends Api
{
    /**
     * List folders.
     *
     * @param  array $params
     * @return mixed
     */
    public function list($params = [])
    {
        $response = $this->client->get('folders', $params);

        return $response->folders;
    }
}
