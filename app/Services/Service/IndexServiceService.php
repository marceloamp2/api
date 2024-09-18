<?php

namespace App\Services\Service;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndexServiceService
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $search = $data['filters']['search'] ?? null;
        $status = $data['filters']['status'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->service
            ->with([
                'serviceValueRanges'
            ])
            ->when($status, function ($query) use ($status) {
                return $query->whereIn('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
