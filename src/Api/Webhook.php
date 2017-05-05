<?php

namespace Groove\Api;

use Groove\Api;

class Webhook extends Api
{
    /**
     * Create a webhook.
     *
     * @param  string $event
     * @param  string $url
     * @return mixed
     */
    public function create($event, $url)
    {
        $response = $this->client->post('webhooks', ['event' => $event, 'url' => $url]);

        return $response->webhook;
    }
}
