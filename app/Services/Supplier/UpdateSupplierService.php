<?php

namespace App\Services\Supplier;

class UpdateSupplierService
{
    public function run(array $data, object $supplier): object
    {
        $supplier->update($data);
        return $supplier;
    }
}
