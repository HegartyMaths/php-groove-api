<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Message as Model;

class Message extends Api
{
    /**
     * List messages for a ticket.
     *
     * @param  int $ticketNumber
     * @param  array $params
     * @return \Illuminate\Support\Collection
     */
    public function list($ticketNumber, $params = [])
    {
        $response = $this->client->get("tickets/$ticketNumber/messages", $params);

        return collect($response->messages)->transform(function ($ticket) {
            return new Model($ticket, $this->client);
        });
    }

    /**
     * Find a message.
     *
     * @param  int|string $messageID
     * @return Model
     */
    public function find($messageID)
    {
        $response = $this->client->get("messages/$messageID");

        return new Model($response->message, $this->client);
    }

    /**
     * Create a message for a ticket.
     *
     * @param  int $ticketNumber
     * @param  string $body
     * @param  array $params
     * @return Model
     */
    public function create($ticketNumber, $body, $params = [])
    {
        $params = array_merge(['body' => $body], $params);

        $response = $this->client->post("tickets/$ticketNumber/messages", $params);

        return new Model($response->message, $this->client);
    }
}
