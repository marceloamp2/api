<?php

namespace App\Services\Order;

class DeleteOrderService
{
    public function run(object $order): bool
    {
        return $order->delete();
    }
}
