<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Attachment as Model;

class Attachment extends Api
{
    /**
     * List attachments.
     *
     * @param  string $messageID
     * @return \Illuminate\Support\Collection
     */
    public function list($messageID)
    {
        $response = $this->client->get('attachments', ['message' => $messageID]);

        return collect($response->attachments)->transform(function ($attachment) {
            return new Model($attachment, $this->client);
        });
    }
}
