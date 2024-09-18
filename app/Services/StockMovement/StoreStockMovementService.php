<?php

namespace App\Services\StockMovement;

use App\Models\Stock;
use App\Models\StockMovement;

class StoreStockMovementService
{
    private StockMovement $stockMovement;
    private Stock $stock;

    public function __construct(StockMovement $stockMovement, Stock $stock)
    {
        $this->stockMovement = $stockMovement;
        $this->stock = $stock;
    }

    public function run(array $data): object
    {
        $stockMovement = $this->stockMovement->create($data);

        foreach ($data['inputs'] as $input) {
            if ($data['type'] === 'in') {
                $stockMovement->inputs()->attach($input['input_id'], [
                    'quantity' => $input['quantity'],
                    'unitary_value' => $input['unitary_value'],
                    'total_value' => $input['quantity'] * $input['unitary_value'],
                ]);

                $this->stock
                    ->where('input_id', $input['input_id'])
                    ->increment('quantity', $input['quantity']);
            } else {
                $stockMovement->inputs()->attach($input['input_id'], [
                    'quantity' => $input['quantity'],
                    'unitary_value' => null,
                    'total_value' => null,
                ]);

                $this->stock
                    ->where('input_id', $input['input_id'])
                    ->decrement('quantity', $input['quantity']);
            }
        }

        return $stockMovement->load('inputs');
    }
}
