<?php

namespace App\Services\Service;

class DeleteServiceService
{
    public function run(object $service): bool
    {
        return $service->delete();
    }
}
