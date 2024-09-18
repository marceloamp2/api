<?php

namespace App\Services\StockMovement;

use App\Models\Stock;

class UpdateStockMovementService
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function run(array $data, object $stockMovement): object
    {
        $this->resetPreviousStock($stockMovement);

        $stockMovement->update($data);

        $stockMovement->inputs()->detach();

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

    public function resetPreviousStock($stockMovement): void
    {
        foreach ($stockMovement->inputs as $input) {
            if ($stockMovement->type === 'in') {
                $this->stock
                    ->where('input_id', $input->id)
                    ->decrement('quantity', $input->pivot->quantity);
            } else {
                $this->stock
                    ->where('input_id', $input->id)
                    ->increment('quantity', $input->pivot->quantity);
            }
        }
    }
}
