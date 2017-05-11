<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Folder;

class FolderTest extends TestCase
{
    /** @test */
    public function it_can_list_folders()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->with('folders', [])
            ->once()
            ->andReturn(json_decode('{"folders": [{"name": "a folder"}]}'));

        $response = (new Folder($client))->list();

        $this->assertEquals($response[0]->name, 'a folder');
    }
}
