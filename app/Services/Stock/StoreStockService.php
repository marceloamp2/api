<?php

namespace App\Services\Stock;

use App\Models\Stock;

class StoreStockService
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function run(array $data): object
    {
        return $this->stock->create($data);
    }
}
