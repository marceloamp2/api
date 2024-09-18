<?php

namespace App\Services\Service;

use App\Models\Service;

class StoreServiceService
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function run(array $data): object
    {
        return $this->service->create($data);
    }
}
