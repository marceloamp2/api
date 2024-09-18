<?php

namespace App\Services\Customer;

use App\Models\Customer;

class StoreCustomerService
{
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function run(array $data): object
    {
        return $this->customer->create($data);
    }
}
