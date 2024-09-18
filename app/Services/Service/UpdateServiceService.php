<?php

namespace App\Services\Service;

class UpdateServiceService
{
    public function run(array $data, object $service): object
    {
        $service->update($data);
        return $service;
    }
}
