<?php

namespace App\Services\Order;

class UpdateOrderService
{
    public function run(array $data, object $order): object
    {
        $order->update($data);
        return $order;
    }
}
