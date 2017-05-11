<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Message;
use Illuminate\Support\Collection;
use Groove\Models\Message as MessageModel;

class MessageTest extends TestCase
{
    /** @test */
    public function it_can_list_messages()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('tickets/ticketNumber/messages', [])
            ->once()
            ->andReturn(json_decode('{"messages": [{}]}'));

        $messages = (new Message($client))->list('ticketNumber');

        $this->assertInstanceOf(Collection::class, $messages);
        $this->assertInstanceOf(MessageModel::class, $messages[0]);
    }

    /** @test */
    public function it_can_find_a_message()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('messages/messageId')
            ->once()
            ->andReturn(json_decode('{"message": {"body" : "message body"}}'));

        $message = (new Message($client))->find('messageId');

        $this->assertInstanceOf(MessageModel::class, $message);
        $this->assertEquals('message body', $message->body);
    }

    /** @test */
    public function it_can_create_a_message()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('post')
            ->with('tickets/ticketNumber/messages', ['body' => 'a new message'])
            ->once()
            ->andReturn(json_decode('{"message": {"body" : "a new message"}}'));

        $message = (new Message($client))->create('ticketNumber', 'a new message');

        $this->assertInstanceOf(MessageModel::class, $message);
        $this->assertEquals('a new message', $message->body);
    }
}
