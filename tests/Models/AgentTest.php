<?php

namespace Tests\Models;

use Mockery;
use Groove\Client;
use Tests\TestCase;
use Groove\Models\Agent;
use Illuminate\Support\Collection;

class AgentTest extends TestCase
{
    private $agent;

    protected function setUp()
    {
        parent::setUp();

        $this->agent = json_decode('{"links": {"groups": {"href": "groups-link"}, "tickets": {"href": "tickets-link"}}}');
    }

    /** @test */
    function it_can_find_an_agents_groups()
    {
        $client = Mockery::spy(Client::class);
        $agent = new Agent($this->agent, $client);

        $groups = $agent->groups();

        $this->assertInstanceOf(Collection::class, $groups);
        $client->shouldHaveReceived('get')->once()->with('groups-link');
    }

    /** @test */
    function it_can_find_an_agents_tickets()
    {
        $client = Mockery::spy(Client::class);
        $agent = new Agent($this->agent, $client);

        $groups = $agent->tickets();

        $this->assertInstanceOf(Collection::class, $groups);
        $client->shouldHaveReceived('get')->once()->with('tickets-link');
    }
}
