<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Mailbox;
use Illuminate\Support\Collection;
use Groove\Models\Mailbox as MailboxModel;

class MailboxTest extends TestCase
{
    /** @test */
    public function it_can_list_mailboxes()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('mailboxes')
            ->once()
            ->andReturn(json_decode('{"mailboxes": [{}]}'));

        $agents = (new Mailbox($this->mockedClient))->list();

        $this->assertInstanceOf(Collection::class, $agents);
        $this->assertInstanceOf(MailboxModel::class, $agents[0]);
    }
}
