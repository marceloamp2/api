<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillsToPay\IndexBillsToPayRequest;
use App\Http\Requests\BillsToPay\StoreBillsToPayRequest;
use App\Http\Requests\BillsToPay\UpdateBillsToPayRequest;
use App\Models\BillsToPay;
use App\Services\BillsToPay\DeleteBillsToPayService;
use App\Services\BillsToPay\IndexBillsToPayService;
use App\Services\BillsToPay\StoreBillsToPayService;
use App\Services\BillsToPay\UpdateBillsToPayService;
use Illuminate\Http\JsonResponse;

class BillsToPayController extends Controller
{
    public function index(
        IndexBillsToPayRequest $indexBillsToPayRequest,
        IndexBillsToPayService $indexBillsToPayService
    ): JsonResponse
    {
        $data = $indexBillsToPayRequest->validated();
        $billsToPay = $indexBillsToPayService->run($data);
        return response()->json($billsToPay);
    }

    public function store(
        StoreBillsToPayRequest $storeBillsToPayRequest,
        StoreBillsToPayService $storeBillsToPayService,
    ): JsonResponse
    {
        $data = $storeBillsToPayRequest->validated();
        $billsToPay = $storeBillsToPayService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Contas a pagar criada com sucesso',
            'data' => $billsToPay
        ]);
    }

    public function update(
        UpdateBillsToPayRequest $updateBillsToPayRequest,
        UpdateBillsToPayService $updateBillsToPayService,
        BillsToPay              $billsToPay
    ): JsonResponse
    {
        $data = $updateBillsToPayRequest->validated();
        $billsToPay = $updateBillsToPayService->run($data, $billsToPay);
        return response()->json([
            'status' => 'success',
            'message' => 'Contas a pagar atualizada com sucesso',
            'data' => $billsToPay
        ]);
    }

    public function destroy(
        DeleteBillsToPayService $deleteBillsToPayService,
        BillsToPay              $billsToPay
    ): JsonResponse
    {
        $deleteBillsToPayService->run($billsToPay);

        return response()->json([
            'status' => 'success',
            'message' => 'Contas a pagar apagada com sucesso!'
        ]);
    }
}
