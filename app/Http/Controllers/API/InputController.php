<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Input\IndexInputRequest;
use App\Http\Requests\Input\StoreInputRequest;
use App\Http\Requests\Input\UpdateInputRequest;
use App\Models\Input;
use App\Services\Input\DeleteInputService;
use App\Services\Input\IndexInputService;
use App\Services\Input\StoreInputService;
use App\Services\Input\UpdateInputService;
use App\Services\Stock\StoreStockService;
use Illuminate\Http\JsonResponse;

class InputController extends Controller
{
    public function index(
        IndexInputRequest $indexInputRequest,
        IndexInputService $indexInputService
    ): JsonResponse
    {
        $data = $indexInputRequest->validated();
        $inputs = $indexInputService->run($data);
        return response()->json($inputs);
    }

    public function store(
        StoreInputRequest $storeInputRequest,
        StoreInputService $storeInputService,
        StoreStockService $storeStockService
    ): JsonResponse
    {
        $data = $storeInputRequest->validated();
        $input = $storeInputService->run($data);

        $data['input_id'] = $input->id;
        $data['quantity'] = 0;
        $storeStockService->run($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Insumo criado com sucesso',
            'data' => $input
        ]);
    }

    public function update(
        UpdateInputRequest $updateInputRequest,
        UpdateInputService $updateInputService,
        Input              $input
    ): JsonResponse
    {
        $data = $updateInputRequest->validated();
        $input = $updateInputService->run($data, $input);
        return response()->json([
            'status' => 'success',
            'message' => 'Insumo atualizado com sucesso',
            'data' => $input
        ]);
    }

    public function destroy(
        DeleteInputService $deleteInputService,
        Input              $input
    ): JsonResponse
    {
        if ($input->stock()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, estoque vinculado'
            ]);
        }

        if ($input->stockMovements()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, movimentação de estoque vinculado'
            ]);
        }

        $deleteInputService->run($input);

        return response()->json([
            'status' => 'success',
            'message' => 'Insumo apagado com sucesso!'
        ]);
    }
}
