<?php

namespace Tests\Models;

use Mockery;
use Groove\Client;
use Tests\TestCase;
use Groove\Models\Ticket;
use Groove\Models\Customer;
use Illuminate\Support\Collection;

class TicketTest extends TestCase
{
    private $agent;

    protected function setUp()
    {
        parent::setUp();

        $this->agent = json_decode('{"links": {"customer": {"id": "customer-id"}}, "number": "ticket-number"}');
    }

    /** @test */
    public function it_can_find_a_tickets_messages()
    {
        $client = Mockery::spy(Client::class);
        $agent = new Ticket($this->agent, $client);

        $messages = $agent->messages();

        $this->assertInstanceOf(Collection::class, $messages);
        $client->shouldHaveReceived('get')->once()->with('tickets/ticket-number/messages');
    }

    /** @test */
    public function it_can_find_a_tickets_customer()
    {
        $client = Mockery::mock(Client::class);
        $client->shouldReceive('get')->once()->andReturn(json_decode('{"customer": {}}'));
        $ticket = new Ticket($this->agent, $client);

        $customer = $ticket->customer();

        $this->assertInstanceOf(Customer::class, $customer);
    }
}
