<?php

namespace App\Services\ServiceValueRange;

use App\Models\ServiceValueRange;

class StoreServiceValueRangeService
{
    private ServiceValueRange $serviceValueRange;

    public function __construct(ServiceValueRange $serviceValueRange)
    {
        $this->serviceValueRange = $serviceValueRange;
    }

    public function run(int $serviceId, array $serviceValueRangesData): bool
    {
        foreach ($serviceValueRangesData as $serviceValueRangeData) {
            $serviceValueRangeData['service_id'] = $serviceId;
            $this->serviceValueRange->create($serviceValueRangeData);
        }

        return true;
    }
}
