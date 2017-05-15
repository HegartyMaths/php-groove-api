<?php

namespace Tests;

use Groove\Model;

class ModelTest extends TestCase
{
    /** @test */
    public function it_can_return_to_a_string()
    {
        $model = new TestModel(['name' => 'agent name'], null);

        $this->assertEquals('{"name":"agent name"}', $model->__toString());
    }

    /** @test */
    public function it_can_return_to_json()
    {
        $model = new TestModel(['email' => 'agent email'], null);

        $this->assertEquals(['email' => 'agent email'], $model->jsonSerialize());
    }
}

class TestModel extends Model
{
    //
}
