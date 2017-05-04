<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Agent;
use Illuminate\Support\Collection;
use Groove\Models\Agent as AgentModel;

class AgentTest extends TestCase
{
    const AGENT_EMAIL = 'test@email.com';

    /** @test */
    public function it_can_find_a_list_of_agents()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('agents')
            ->once()
            ->andReturn(json_decode('{"agents": [{}]}'));

        $agents = (new Agent($client))->list();

        $this->assertInstanceOf(Collection::class, $agents);
        $this->assertInstanceOf(AgentModel::class, $agents[0]);
    }

    /** @test */
    public function it_can_find_an_agent()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('agents/'.self::AGENT_EMAIL)
            ->once()
            ->andReturn(json_decode('{"agent": {"email" : "'.self::AGENT_EMAIL.'"}}'));

        $agent = (new Agent($client))->find(self::AGENT_EMAIL);

        $this->assertInstanceOf(AgentModel::class, $agent);
        $this->assertEquals(self::AGENT_EMAIL, $agent->email);
    }
}
