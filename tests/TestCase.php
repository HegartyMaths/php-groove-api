<?php

namespace Tests;

use Mockery;
use Groove\Client as Groove;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * Get mocked client.
     *
     * @return Mockery\Mock
     */
    public function getMockClient()
    {
        return Mockery::mock(Groove::class, ['accessToken'])->makePartial();
    }
}
