<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Attachment as Model;

class Attachment extends Api
{
    /**
     * List attachments.
     *
     * @return \Illuminate\Support\Collection
     */
    public function list()
    {
        $response = $this->client->get('attachments');

        return collect($response->attachments)->transform(function ($attachment) {
            return new Model($attachment, $this->client);
        });
    }
}
