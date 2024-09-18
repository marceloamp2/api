<?php

namespace App\Services\User;

use App\Models\User;

class IndexUserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run($data)
    {
        $search = $data['filters']['search'] ?? null;
        $status = $data['filters']['status'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->user
            ->when($status, function ($query) use ($status) {
                return $query->whereIn('status', $status);
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
