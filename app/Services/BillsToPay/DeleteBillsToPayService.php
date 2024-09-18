<?php

namespace App\Services\BillsToPay;

class DeleteBillsToPayService
{
    public function run(object $billsToPay): bool
    {
        return $billsToPay->delete();
    }
}
