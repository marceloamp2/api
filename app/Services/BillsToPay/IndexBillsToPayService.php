<?php

namespace App\Services\BillsToPay;

use App\Models\BillsToPay;

class IndexBillsToPayService
{
    private BillsToPay $billsToPay;

    public function __construct(BillsToPay $billsToPay)
    {
        $this->billsToPay = $billsToPay;
    }

    public function run($data)
    {
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->billsToPay->orderBy('due_date');

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
