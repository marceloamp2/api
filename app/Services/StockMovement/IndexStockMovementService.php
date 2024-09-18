<?php

namespace App\Services\StockMovement;

use App\Models\StockMovement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndexStockMovementService
{
    private StockMovement $stockMovement;

    public function __construct(StockMovement $stockMovement)
    {
        $this->stockMovement = $stockMovement;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $types = $data['filters']['types'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->stockMovement
            ->with([
                'inputs'
            ])
            ->when($types, function ($query) use ($types) {
                return $query->whereIn('type', $types);
            })
            ->orderBy('created_at', 'desc');

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
