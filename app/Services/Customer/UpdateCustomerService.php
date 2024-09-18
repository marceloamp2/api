<?php

namespace App\Services\Customer;

class UpdateCustomerService
{
    public function run(array $data, object $customer): object
    {
        $customer->update($data);
        return $customer;
    }
}
