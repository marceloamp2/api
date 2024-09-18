<?php

namespace App\Services\BillsToPay;

class UpdateBillsToPayService
{
    public function run(array $data, object $billsToPay): object
    {
        $billsToPay->update($data);
        return $billsToPay;
    }
}
