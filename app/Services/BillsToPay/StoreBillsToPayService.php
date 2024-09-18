<?php

namespace App\Services\BillsToPay;

use App\Models\BillsToPay;

class StoreBillsToPayService
{
    private BillsToPay $billsToPay;

    public function __construct(BillsToPay $billsToPay)
    {
        $this->billsToPay = $billsToPay;
    }

    public function run(array $data): object
    {
        return $this->billsToPay->create($data);
    }
}
