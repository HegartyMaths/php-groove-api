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
     * @param  array $params
     * @return \Illuminate\Support\Collection
     */
    public function list($params = [])
    {
        $response = $this->client->get('tickets', $params);

        return collect($response->tickets)->transform(function ($ticket) {
            return new Model($ticket, $this->client);
        });
    }

    /**
     * Find ticket.
     *
     * @param  int|string $ticketNumber
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
     * @param  int|string $ticketNumber
     * @return mixed
     */
    public function ticketState($ticketNumber)
    {
        return $this->client->get("tickets/$ticketNumber/state");
    }

    /**
     * Ticket assignee.
     *
     * @param  int|string $ticketNumber
     * @return mixed
     */
    public function ticketAssignee($ticketNumber)
    {
        return $this->client->get("tickets/$ticketNumber/assignee");
    }

    /**
     * Update a ticket's assignee.
     *
     * @param  int|string $ticketNumber
     * @param  string $email
     * @return bool
     */
    public function updateAssignee($ticketNumber, $email)
    {
        $this->client->put("tickets/$ticketNumber/assignee", ['assignee' => $email]);

        return true;
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

    /**
     * Update a ticket's priority.
     *
     * @param  int|string $ticketNumber
     * @param  string $priority
     * @return bool
     */
    public function updatePriority($ticketNumber, $priority)
    {
        $this->client->put("tickets/$ticketNumber/priority", ['priority' => $priority]);

        return true;
    }

    /**
     * Update a ticket's assigned group.
     *
     * @param  int|string $ticketNumber
     * @param  string $groupID
     * @return bool
     */
    public function updateGroup($ticketNumber, $groupID)
    {
        $this->client->put("tickets/$ticketNumber/assigned_group", ['group' => $groupID]);

        return true;
    }
}
