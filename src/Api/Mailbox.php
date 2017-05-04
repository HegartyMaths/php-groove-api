<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Mailbox as Model;

class Mailbox extends Api
{
    /**
     * List mailboxes.
     *
     * @return \Illuminate\Support\Collection
     */
    public function list()
    {
        $response = $this->client->get('mailboxes');

        return collect($response->mailboxes)->transform(function ($ticket) {
            return new Model($ticket, $this->client);
        });
    }
}
