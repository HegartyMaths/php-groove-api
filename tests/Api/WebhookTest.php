<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Webhook;
use Groove\Models\Webhook as WebhookModel;

class WebhookTest extends TestCase
{
    /** @test */
    public function it_can_create_a_webhook()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('post')
            ->with('webhooks', ['event' => 'groove-event', 'url' => 'your-url'])
            ->once()
            ->andReturn(json_decode('{"webhook": {"event": "groove-event", "url": "your-url"}}'));

        $webhook = (new Webhook($client))->create('groove-event', 'your-url');

        $this->assertInstanceOf(WebhookModel::class, $webhook);
        $this->assertEquals($webhook->event, 'groove-event');
        $this->assertEquals($webhook->url, 'your-url');
    }
}
