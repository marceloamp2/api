<?php

namespace App\Services\Customer;

class DeleteCustomerService
{
    public function run(object $customer): bool
    {
        $customer->address()->delete();
        $customer->orders()->delete();
        return $customer->delete();
    }
}
