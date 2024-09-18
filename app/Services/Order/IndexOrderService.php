<?php

namespace App\Services\Order;

use App\Models\Order;

class IndexOrderService
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function run($data)
    {
        $search = $data['filters']['search'] ?? null;
        $status = $data['filters']['status'] ?? null;
        $paginate = isset($data['paginate']) && filter_var($data['paginate'], FILTER_VALIDATE_BOOLEAN);

        $query = $this->order
            ->with([
                'company',
                'customer.naturalPerson',
                'customer.legalPerson',
                'customer.address',
                'paymentMethod',
                'projects.services',
                'projects.images'
            ])
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
