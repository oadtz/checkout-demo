<?php
namespace App\Services\Interfaces;

use App\Repositories\Interfaces\OrderRepositoryInterface;

interface OrderServiceInterface {
    public function __construct (\Oadtz\Checkout\Interfaces\CheckoutInterface $checkout, OrderRepositoryInterface $order);
    public function checkout ();
}