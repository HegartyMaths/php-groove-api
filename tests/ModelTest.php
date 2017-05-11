<?php

namespace Tests;

use Groove\Models\Agent;

class ModelTest extends TestCase
{
    /** @test */
    public function it_can_return_to_a_string()
    {
        $model = new Agent(['name' => 'agent name'], null);

        $this->assertEquals('{"name":"agent name"}', $model->__toString());
    }

    /** @test */
    public function it_can_return_to_json()
    {
        $model = new Agent(['email' => 'agent email'], null);

        $this->assertEquals('{"email":"agent email"}', $model->toJson());
    }
}
