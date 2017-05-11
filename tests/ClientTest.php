<?php

namespace Tests;

use Groove\Client;
use Groove\Api\Agent;
use Groove\Api\Group;
use Groove\Api\Folder;
use Groove\Api\Ticket;
use Groove\Api\Mailbox;
use Groove\Api\Message;
use Groove\Api\Webhook;
use Groove\Api\Customer;
use Groove\Api\Attachment;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;

class ClientTest extends TestCase
{
    /** @test */
    public function it_provides_access_to_agents()
    {
        $agents = (new Client('token'))->agents();

        $this->assertInstanceOf(Agent::class, $agents);
    }

    /** @test */
    public function it_provides_access_to_tickets()
    {
        $tickets = (new Client('token'))->tickets();

        $this->assertInstanceOf(Ticket::class, $tickets);
    }

    /** @test */
    public function it_provides_access_to_customers()
    {
        $customers = (new Client('token'))->customers();

        $this->assertInstanceOf(Customer::class, $customers);
    }

    /** @test */
    public function it_provides_access_to_mailboxes()
    {
        $customers = (new Client('token'))->mailboxes();

        $this->assertInstanceOf(Mailbox::class, $customers);
    }

    /** @test */
    public function it_provides_access_to_attachments()
    {
        $attachments = (new Client('token'))->attachments();

        $this->assertInstanceOf(Attachment::class, $attachments);
    }

    /** @test */
    public function it_provides_access_to_groups()
    {
        $groups = (new Client('token'))->groups();

        $this->assertInstanceOf(Group::class, $groups);
    }

    /** @test */
    public function it_provides_access_to_folders()
    {
        $folders = (new Client('token'))->folders();

        $this->assertInstanceOf(Folder::class, $folders);
    }

    /** @test */
    public function it_provides_access_to_messages()
    {
        $messages = (new Client('token'))->messages();

        $this->assertInstanceOf(Message::class, $messages);
    }

    /** @test */
    public function it_provides_access_to_webhooks()
    {
        $webhooks = (new Client('token'))->webhooks();

        $this->assertInstanceOf(Webhook::class, $webhooks);
    }

    /** @test */
    public function it_can_get_the_access_token()
    {
        $accessToken = (new Client('anAccessToken'))->getAccessToken();

        $this->assertEquals('anAccessToken', $accessToken);
    }

    /** @test */
    public function it_can_make_get_requests()
    {
        $mock = new MockHandler([new Response(200, [], '"a test get response"')]);
        $handler = HandlerStack::create($mock);
        $httpClient = new Guzzle(['handler' => $handler]);

        $response = (new Client('token', $httpClient))->get('endpoint');

        $this->assertEquals('a test get response', $response);
    }

    /** @test */
    public function it_can_make_post_requests()
    {
        $mock = new MockHandler([new Response(200, [], '"a test post response"')]);
        $handler = HandlerStack::create($mock);
        $httpClient = new Guzzle(['handler' => $handler]);

        $response = (new Client('token', $httpClient))->post('endpoint');

        $this->assertEquals('a test post response', $response);
    }

    /** @test */
    public function it_can_make_put_requests()
    {
        $mock = new MockHandler([new Response(200, [], '"a test put response"')]);
        $handler = HandlerStack::create($mock);
        $httpClient = new Guzzle(['handler' => $handler]);

        $response = (new Client('token', $httpClient))->put('endpoint');

        $this->assertEquals('a test put response', $response);
    }
}
