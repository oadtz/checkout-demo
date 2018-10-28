<?php

namespace Tests\Unit;

use Mockery;
use App\Services\OrderService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $order;

    public function testCheckout () {
        $checkout = Mockery::mock('Oadtz\Checkout\Interfaces\CheckoutInterface');
        $checkout->shouldReceive([
            'setCardNumber'     => null,
            'setCardHolderName' => null,
            'setCardExpiryDate' => null,
            'setCardCVV'        => null,
            'setAmount'         => null,
            'setCurrency'       => null,
            'setSupplementData' => null,
            'processPayment->getSuccess'    => true,
            'processPayment->getPaymentGateway'    => 'bnk48',
            'processPayment->getResponseData'    => [],
        ]);
        $orderRepo = Mockery::mock('App\Repositories\Interfaces\OrderRepositoryInterface');
        $orderRepo->shouldReceive([
            'store'     =>  new \App\Order([ 'status' => 'SUCCESS' ])
        ]);
        $this->order = new OrderService($checkout, $orderRepo);

        $this->assertInstanceOf(\App\Order::class, $this->order->checkout());
    }
}
