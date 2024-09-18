<?php

namespace App\Services\Expense;

use App\Models\Expense;

class IndexExpenseService
{
    private Expense $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function run($data)
    {
        $search = $data['filters']['search'] ?? null;
        $types = $data['filters']['types'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->expense
            ->when($types, function ($query) use ($types) {
                return $query->whereIn('type', $types);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', $search . '%');
            });

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
