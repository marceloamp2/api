<?php

namespace App\Services\Supplier;

use App\Models\Supplier;

class StoreSupplierService
{
    private Supplier $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function run(array $data): object
    {
        return $this->supplier->create($data);
    }
}
