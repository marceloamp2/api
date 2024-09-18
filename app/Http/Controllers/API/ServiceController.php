<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\IndexServiceRequest;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Services\Service\DeleteServiceService;
use App\Services\Service\IndexServiceService;
use App\Services\Service\StoreServiceService;
use App\Services\Service\UpdateServiceService;
use App\Services\ServiceValueRange\StoreServiceValueRangeService;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(
        IndexServiceRequest $indexServiceRequest,
        IndexServiceService $indexServiceService
    ): JsonResponse
    {
        $data = $indexServiceRequest->validated();
        $services = $indexServiceService->run($data);
        return response()->json($services);
    }

    public function store(
        StoreServiceRequest           $storeServiceRequest,
        StoreServiceService           $storeServiceService,
        StoreServiceValueRangeService $storeServiceValueRangeService
    ): JsonResponse
    {
        $data = $storeServiceRequest->validated();
        $service = $storeServiceService->run($data['service']);
        $storeServiceValueRangeService->run($service->id, $data['service_value_ranges']);
        $service->load('serviceValueRanges');
        return response()->json([
            'status' => 'success',
            'message' => 'Serviço criado com sucesso',
            'data' => $service
        ]);
    }

    public function update(
        UpdateServiceRequest          $updateServiceRequest,
        UpdateServiceService          $updateServiceService,
        StoreServiceValueRangeService $storeServiceValueRangeService,
        Service                       $service
    ): JsonResponse
    {
        $data = $updateServiceRequest->validated();
        $service = $updateServiceService->run($data['service'], $service);
        $service->serviceValueRanges()->delete();
        $storeServiceValueRangeService->run($service->id, $data['service_value_ranges']);
        $service->load('serviceValueRanges');
        return response()->json([
            'status' => 'success',
            'message' => 'Serviço atualizado com sucesso',
            'data' => $service
        ]);
    }

    public function destroy(
        DeleteServiceService $deleteServiceService,
        Service              $service
    ): JsonResponse
    {
        if ($service->projects()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, projetos vinculados'
            ]);
        }

        $service->serviceValueRanges()->delete();
        $deleteServiceService->run($service);

        return response()->json([
            'status' => 'success',
            'message' => 'Serviço apagado com sucesso!'
        ]);
    }
}
