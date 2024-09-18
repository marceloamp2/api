<?php

namespace App\Services\StockMovement;

use App\Models\Stock;

class DeleteStockMovementService
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }
    public function run(object $stockMovement): bool
    {
        $this->resetPreviousStock($stockMovement);
        $stockMovement->inputs()->detach();
        return $stockMovement->delete();
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
