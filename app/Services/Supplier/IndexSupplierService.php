<?php

namespace App\Services\Supplier;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexSupplierService
{
    private Supplier $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $search = $data['filters']['search'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->supplier
            ->with([
                'naturalPerson',
                'legalPerson',
                'address'
            ])
            ->when($search, function ($query) use ($search) {
                return $query
                    ->whereHas('legalPerson', function (Builder $query) use ($search) {
                        $query->where('cnpj', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('naturalPerson', function (Builder $query) use ($search) {
                        $query->where('cpf', 'like', '%' . $search . '%');
                    });
            });
        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
