<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Group;
use Illuminate\Support\Collection;
use Groove\Models\Group as GroupModel;

class GroupTest extends TestCase
{
    /** @test */
    public function it_can_list_groups()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('groups')
            ->once()
            ->andReturn(json_decode('{"groups": [{}]}'));

        $groups = (new Group($this->mockedClient))->list();

        $this->assertInstanceOf(Collection::class, $groups);
        $this->assertInstanceOf(GroupModel::class, $groups[0]);
    }
}
