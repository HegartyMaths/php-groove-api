<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Attachment;
use Illuminate\Support\Collection;
use Groove\Models\Attachment as AttachmentModel;

class AttachmentTest extends TestCase
{
    /** @test */
    function it_can_list_attachments()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('attachments')
            ->once()
            ->andReturn(json_decode('{"attachments": [{}]}'));

        $attachments = (new Attachment($client))->list();

        $this->assertInstanceOf(Collection::class, $attachments);
        $this->assertInstanceOf(AttachmentModel::class, $attachments[0]);
    }
}
