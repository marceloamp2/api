<?php

namespace App\Services\Supplier;

class DeleteSupplierService
{
    public function run(object $supplier): bool
    {
        return $supplier->delete();
    }
}
