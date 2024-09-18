<?php

namespace App\Services\Project;

use App\Services\ServiceValueRange\GetServiceValueRangeByIntervalFromToService;

class AttachServicesToProjectService
{
    private GetServiceValueRangeByIntervalFromToService $getServiceValueRangeByIntervalFromToService;

    public function __construct(GetServiceValueRangeByIntervalFromToService $getServiceValueRangeByIntervalFromToService)
    {
        $this->getServiceValueRangeByIntervalFromToService = $getServiceValueRangeByIntervalFromToService;
    }

    public function run(array $dataServices, object $project): void
    {
        $project->services()->detach();

        foreach ($dataServices as $service) {
            $serviceValueRange = $this->getServiceValueRangeByIntervalFromToService->run($service['quantity'], $service['id']);

            $project->services()->attach($service['id'], [
                'quantity' => $service['quantity'],
                'unitary_value' => $serviceValueRange->unitary_value,
                'total_value' => $service['quantity'] * $serviceValueRange->unitary_value,
            ]);
        }
    }
}
