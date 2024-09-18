<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\IndexStockRequest;
use App\Services\Stock\IndexStockService;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function index(
        IndexStockRequest $indexStockRequest,
        IndexStockService $indexStockService
    ): JsonResponse
    {
        $data = $indexStockRequest->validated();
        $stockMovements = $indexStockService->run($data);
        return response()->json($stockMovements);
    }
}
