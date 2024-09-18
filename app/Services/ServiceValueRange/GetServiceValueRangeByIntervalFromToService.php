<?php

namespace App\Services\ServiceValueRange;

use App\Models\ServiceValueRange;

class GetServiceValueRangeByIntervalFromToService
{
    private ServiceValueRange $serviceValueRange;

    public function __construct(ServiceValueRange $serviceValueRange)
    {
        $this->serviceValueRange = $serviceValueRange;
    }

    public function run(int $quantity, int $serviceId): ServiceValueRange
    {
        return $this->serviceValueRange::where('service_id', $serviceId)
            ->where('from', '<=', $quantity)
            ->where('to', '>=', $quantity)
            ->first();
    }
}
