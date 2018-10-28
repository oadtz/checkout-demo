<?php
namespace App\Repositories;

use App\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface {
    public function store (array $data) {
        return Order::create($data);
    }
}