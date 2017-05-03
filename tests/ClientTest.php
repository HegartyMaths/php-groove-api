<?php

namespace Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Groove\Client;
use Groove\Api\Agent;
use Groove\Api\Ticket;
use Groove\Api\Customer;
use GuzzleHttp\Client as Guzzle;

class ClientTest extends TestCase
{
    /** @test */
    function it_provides_access_to_agents()
    {
        $agents = (new Client('token'))->agents();

        $this->assertInstanceOf(Agent::class, $agents);
    }

    /** @test */
    function it_provides_access_to_tickets()
    {
        $tickets = (new Client('token'))->tickets();

        $this->assertInstanceOf(Ticket::class, $tickets);
    }

    /** @test */
    function it_provides_access_to_customers()
    {
        $customers = (new Client('token'))->customers();

        $this->assertInstanceOf(Customer::class, $customers);
    }

    /** @test */
    function it_can_get_the_access_token()
    {
        $accessToken = (new Client('anAccessToken'))->getAccessToken();

        $this->assertEquals('anAccessToken', $accessToken);
    }

    /** @test */
    function it_can_set_the_access_token()
    {
        $client = new Client('originalAccessToken');

        $client->setAccessToken('newAccessToken');

        $this->assertEquals('newAccessToken', $client->getAccessToken());
    }

    /** @test */
    function it_can_make_get_requests()
    {
        $mock = new MockHandler([new Response(200, [], '"a test get response"')]);
        $handler = HandlerStack::create($mock);
        $httpClient = new Guzzle(['handler' => $handler]);

        $response = (new Client('token', $httpClient))->get('endpoint');

        $this->assertEquals('a test get response', $response);
    }

    /** @test */
    function it_can_make_post_requests()
    {
        $mock = new MockHandler([new Response(200, [], '"a test post response"')]);
        $handler = HandlerStack::create($mock);
        $httpClient = new Guzzle(['handler' => $handler]);

        $response = (new Client('token', $httpClient))->post('endpoint');

        $this->assertEquals('a test post response', $response);
    }
}
