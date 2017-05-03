<?php

namespace Tests\Api;

use Tests\TestCase;
use Groove\Api\Customer;
use Illuminate\Support\Collection;
use Groove\Models\Customer as CustomerModel;

class CustomerTest extends TestCase
{
    const CUSTOMER_EMAIL = 'test@email.com';

    /** @test */
    function it_can_find_a_list_of_customers()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->once()
            ->andReturn(json_decode('{"customers": [{}]}'));

        $customers = (new Customer($client))->list();

        $this->assertInstanceOf(Collection::class, $customers);
        $this->assertInstanceOf(CustomerModel::class, $customers[0]);
    }

    /** @test */
    function it_can_find_a_customer()
    {
        $client = $this->getMockClient();
        $client
            ->shouldReceive('get')
            ->once()
            ->andReturn(json_decode('{"customer": {"email": "' . self::CUSTOMER_EMAIL . '"}}'));

        $customer =  (new Customer($client))->find(self::CUSTOMER_EMAIL);

        $this->assertInstanceOf(CustomerModel::class, $customer);
        $this->assertEquals(self::CUSTOMER_EMAIL, $customer->email);
    }
}
