<?php

namespace App\Services\Order;

use App\Models\Order;

class StoreOrderService
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function run(array $data): object
    {
        return $this->order->create($data);
    }
}
