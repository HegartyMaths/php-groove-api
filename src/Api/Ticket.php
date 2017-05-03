<?php

namespace Groove\Api;

use Groove\Api;
use Groove\Models\Ticket as Model;

class Ticket extends Api
{
    /**
     * Create ticket.
     *
     * @param  string $body
     * @param  string|array $from
     * @param  string|array $to
     * @param  array $params
     * @return Model
     */
    public function create($body, $from, $to, $params = [])
    {
        $params = array_merge(['body' => $body, 'from' => $from, 'to' => $to], $params);

        $response = $this->client->post('tickets', $params);

        return new Model($response->ticket, $this->client);
    }

    /**
     * List tickets.
     *
     * @param  int $page
     * @return \Illuminate\Support\Collection
     */
    public function list($page = 1)
    {
        $response = $this->client->get("tickets?page=$page");

        return collect($response->tickets)->transform(function ($ticket) {
            return new Model($ticket, $this->client);
        });
    }

    /**
     * Find ticket.
     *
     * @param  $ticketNumber
     * @return Model
     */
    public function find($ticketNumber)
    {
        $ticket = $this->client->get("tickets/$ticketNumber")->ticket;

        return new Model($ticket, $this->client);
    }

    /**
     * Ticket state.
     *
     * @param  $ticketNumber
     * @return mixed
     */
    public function ticketState($ticketNumber)
    {
        return $this->client->get("tickets/$ticketNumber/state");
    }

    /**
     * Ticket assignee.
     *
     * @param  $ticketNumber
     * @return mixed
     */
    public function ticketAssignee($ticketNumber)
    {
        return $this->client->get("tickets/$ticketNumber/assignee");
    }

    /**
     * Ticket count.
     *
     * @return mixed
     */
    public function count()
    {
        return $this->client->get('tickets/count');
    }
}
