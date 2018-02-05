<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Ticket;
use Illuminate\Support\Collection;
use Groove\Models\Ticket as TicketModel;

class TicketTest extends TestCase
{
    const TICKET_BODY = 'hello world';
    const TICKET_FROM = 'from@email.com';
    const TICKET_TO = 'to@email.com';
    const TICKET_NUMBER = 123456;

    /** @test */
    public function it_can_create_a_ticket()
    {
        $this->mockedClient
            ->shouldReceive('post')
            ->with('tickets', ['body' => self::TICKET_BODY, 'from' => self::TICKET_FROM, 'to' => self::TICKET_TO])
            ->once()
            ->andReturn(json_decode('{"ticket": {"body": "'.self::TICKET_BODY.'"}}'));

        $ticket = (new Ticket($this->mockedClient))->create(self::TICKET_BODY, self::TICKET_FROM, self::TICKET_TO);

        $this->assertInstanceOf(TicketModel::class, $ticket);
        $this->assertEquals(self::TICKET_BODY, $ticket->body);
    }

    /** @test */
    public function it_can_find_a_list_of_tickets()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('tickets', [])
            ->once()
            ->andReturn(json_decode('{"tickets": [{}]}'));

        $tickets = (new Ticket($this->mockedClient))->list();

        $this->assertInstanceOf(Collection::class, $tickets);
        $this->assertInstanceOf(TicketModel::class, $tickets[0]);
    }

    /** @test */
    public function it_can_find_a_ticket()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('tickets/'.self::TICKET_NUMBER)
            ->once()
            ->andReturn(json_decode('{"ticket": {"number": "'.self::TICKET_NUMBER.'"}}'));

        $ticket = (new Ticket($this->mockedClient))->find(self::TICKET_NUMBER);

        $this->assertInstanceOf(TicketModel::class, $ticket);
        $this->assertEquals(self::TICKET_NUMBER, $ticket->number);
    }

    /** @test */
    public function it_can_update_a_tickets_assignee()
    {
        $this->mockedClient
            ->shouldReceive('put')
            ->with('tickets/'.self::TICKET_NUMBER.'/assignee', ['assignee' => 'assignee@email.com'])
            ->once();

        $updated = (new Ticket($this->mockedClient))->updateAssignee(self::TICKET_NUMBER, 'assignee@email.com');

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_update_a_tickets_priority()
    {
        $this->mockedClient
            ->shouldReceive('put')
            ->with('tickets/'.self::TICKET_NUMBER.'/priority', ['priority' => 'urgent'])
            ->once();

        $updated = (new Ticket($this->mockedClient))->updatePriority(self::TICKET_NUMBER, 'urgent');

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_update_a_tickets_group()
    {
        $this->mockedClient
            ->shouldReceive('put')
            ->with('tickets/'.self::TICKET_NUMBER.'/assigned_group', ['group' => 'groupID'])
            ->once();

        $updated = (new Ticket($this->mockedClient))->updateGroup(self::TICKET_NUMBER, 'groupID');

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_find_a_tickets_state()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('tickets/'.self::TICKET_NUMBER.'/state')
            ->once()
            ->andReturn('unread');

        $status = (new Ticket($this->mockedClient))->ticketState(self::TICKET_NUMBER);

        $this->assertEquals('unread', $status);
    }

    /** @test */
    public function it_can_update_a_tickets_state()
    {
        $this->mockedClient
            ->shouldReceive('put')
            ->with('tickets/'.self::TICKET_NUMBER.'/state', ['state' => 'spam'])
            ->once();

        $updated = (new Ticket($this->mockedClient))->updateState(self::TICKET_NUMBER, 'spam');

        $this->assertTrue($updated);
    }

    /** @test */
    public function it_can_find_a_tickets_assignee()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('tickets/'.self::TICKET_NUMBER.'/assignee')
            ->once()
            ->andReturn('test@email.com');

        $assignee = (new Ticket($this->mockedClient))->ticketAssignee(self::TICKET_NUMBER);

        $this->assertEquals('test@email.com', $assignee);
    }

    /** @test */
    public function it_can_find_a_tickets_count()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('tickets/count')
            ->once()
            ->andReturn('123');

        $assignee = (new Ticket($this->mockedClient))->count();

        $this->assertEquals('123', $assignee);
    }
}
