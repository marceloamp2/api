<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StockMovement\IndexStockMovementRequest;
use App\Http\Requests\StockMovement\StoreStockMovementRequest;
use App\Http\Requests\StockMovement\UpdateStockMovementRequest;
use App\Http\Resources\StockMovementResource;
use App\Models\StockMovement;
use App\Services\StockMovement\DeleteStockMovementService;
use App\Services\StockMovement\IndexStockMovementService;
use App\Services\StockMovement\StoreStockMovementService;
use App\Services\StockMovement\UpdateStockMovementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StockMovementController extends Controller
{
    public function index(
        IndexStockMovementRequest $indexStockMovementRequest,
        IndexStockMovementService $indexStockMovementService
    ): AnonymousResourceCollection
    {
        $data = $indexStockMovementRequest->validated();
        $stockMovements = $indexStockMovementService->run($data);
        return StockMovementResource::collection($stockMovements);
    }

    public function store(
        StoreStockMovementRequest $storeStockMovementRequest,
        StoreStockMovementService $storeStockMovementService,
    ): JsonResponse
    {
        $data = $storeStockMovementRequest->validated();
        $stockMovement = $storeStockMovementService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Movimentação do estoque criada com sucesso',
            'data' => $stockMovement
        ]);
    }

    public function update(
        UpdateStockMovementRequest $updateStockMovementRequest,
        UpdateStockMovementService $updateStockMovementService,
        StockMovement              $stockMovement
    ): JsonResponse
    {
        $data = $updateStockMovementRequest->validated();
        $stockMovement = $updateStockMovementService->run($data, $stockMovement);
        return response()->json([
            'status' => 'success',
            'message' => 'Movimentação do estoque atualizada com sucesso',
            'data' => $stockMovement
        ]);
    }

    public function destroy(
        DeleteStockMovementService $deleteStockMovementService,
        StockMovement              $stockMovement
    ): JsonResponse
    {
        $deleteStockMovementService->run($stockMovement);

        return response()->json([
            'status' => 'success',
            'message' => 'Movimentação do estoque apagada com sucesso!'
        ]);
    }
}
