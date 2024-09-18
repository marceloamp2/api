<?php

namespace App\Services\Stock;

use App\Models\Stock;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexStockService
{
    private Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $search = $data['filters']['search'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->stock
            ->with([
                'input'
            ])
            ->join('inputs', 'stocks.input_id', 'inputs.id')
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('input', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('inputs.name', 'asc');

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
