<?php

namespace Tests;

use Mockery;
use GuzzleHttp\Client;
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
        $httpClient = Mockery::spy(Client::class);
        $client = Mockery::mock(Groove::class, ['accessToken', $httpClient])->makePartial();

        return $client;
    }
}
