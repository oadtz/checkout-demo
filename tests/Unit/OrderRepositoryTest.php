<?php

namespace Tests\Unit;

use App\Order;
use App\Repositories\OrderRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $order;

    public function setUp ()
    {
        parent::setUp();

        $this->order = new OrderRepository;
    }

    public function tearDown () {
        unset ($this->order);
    }

    public function testStoreOrder()
    {
        $orderData = factory(Order::class)->make();
        $input = [
            'customer_name'     =>  $orderData->customer_name,
            'currency'          =>  $orderData->currency,
            'amount'            =>  $orderData->amount,
            'status'            =>  $orderData->status
        ];
        $result = $this->order->store($input);

        $this->assertInstanceOf(Order::class, $result);
        $this->assertGreaterThan(0, $result->id);
        $this->assertEquals($input['customer_name'], $result->customer_name);
        $this->assertEquals($input['currency'], $result->currency);
        $this->assertEquals($input['amount'], $result->amount);
        $this->assertEquals($input['status'], $result->status);
    }
}
