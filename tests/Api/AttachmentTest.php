<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Attachment;
use Illuminate\Support\Collection;
use Groove\Models\Attachment as AttachmentModel;

class AttachmentTest extends TestCase
{
    /** @test */
    public function it_can_list_attachments()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('attachments', ['message' => 'messageID'])
            ->once()
            ->andReturn(json_decode('{"attachments": [{}]}'));

        $attachments = (new Attachment($client))->list('messageID');

        $this->assertInstanceOf(Collection::class, $attachments);
        $this->assertInstanceOf(AttachmentModel::class, $attachments[0]);
    }
}
