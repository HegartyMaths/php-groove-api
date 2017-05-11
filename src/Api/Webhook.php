<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Webhook as Model;

class Webhook extends Api
{
    /**
     * Create a webhook.
     *
     * @param  string $event
     * @param  string $url
     * @return Model
     */
    public function create($event, $url)
    {
        $response = $this->client->post('webhooks', ['event' => $event, 'url' => $url]);

        return new Model($response->webhook, $this->client);
    }
}
