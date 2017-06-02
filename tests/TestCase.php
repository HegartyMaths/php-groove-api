<?php

namespace Tests;

use Mockery;
use Groove\Client as Groove;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    protected $mockedClient;

    protected function setUp()
    {
        parent::setUp();

        $this->mockedClient = Mockery::mock(Groove::class, ['accessToken'])->makePartial();
    }
}
