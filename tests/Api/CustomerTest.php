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
    public function it_can_find_a_list_of_customers()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('customers', [])
            ->once()
            ->andReturn(json_decode('{"customers": [{}]}'));

        $customers = (new Customer($this->mockedClient))->list();

        $this->assertInstanceOf(Collection::class, $customers);
        $this->assertInstanceOf(CustomerModel::class, $customers[0]);
    }

    /** @test */
    public function it_can_find_a_customer()
    {
        $this->mockedClient
            ->shouldReceive('get')
            ->with('customers/'.self::CUSTOMER_EMAIL)
            ->once()
            ->andReturn(json_decode('{"customer": {"email": "'.self::CUSTOMER_EMAIL.'"}}'));

        $customer = (new Customer($this->mockedClient))->find(self::CUSTOMER_EMAIL);

        $this->assertInstanceOf(CustomerModel::class, $customer);
        $this->assertEquals(self::CUSTOMER_EMAIL, $customer->email);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $this->mockedClient
            ->shouldReceive('put')
            ->with('customers/'.self::CUSTOMER_EMAIL, ['email' => 'updated@email.com'])
            ->once()
            ->andReturn(json_decode('{"customer": {"email": "updated@email.com"}}'));

        $customer = (new Customer($this->mockedClient))->update(self::CUSTOMER_EMAIL, 'updated@email.com');

        $this->assertInstanceOf(CustomerModel::class, $customer);
        $this->assertEquals('updated@email.com', $customer->email);
    }
}
