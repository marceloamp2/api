<?php

namespace App\Services\Input;

use App\Models\Input;

class IndexInputService
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
    }

    public function run($data)
    {
        $search = $data['filters']['search'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->input
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', $search . '%');
            })
            ->orderBy('name', 'asc');

        if ($paginate) {
            return $query->paginate(10)->withQueryString();
        }

        return $query->get();
    }
}
