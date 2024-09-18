<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\IndexExpenseRequest;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Models\Expense;
use App\Services\Expense\DeleteExpenseService;
use App\Services\Expense\IndexExpenseService;
use App\Services\Expense\StoreExpenseService;
use App\Services\Expense\UpdateExpenseService;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
    public function index(
        IndexExpenseRequest $indexExpenseRequest,
        IndexExpenseService $indexExpenseService
    ): JsonResponse
    {
        $data = $indexExpenseRequest->validated();
        $expenses = $indexExpenseService->run($data);
        return response()->json($expenses);
    }

    public function store(
        StoreExpenseRequest $storeExpenseRequest,
        StoreExpenseService $storeExpenseService,
    ): JsonResponse
    {
        $data = $storeExpenseRequest->validated();
        $expense = $storeExpenseService->run($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Despesa criada com sucesso',
            'data' => $expense
        ]);
    }

    public function update(
        UpdateExpenseRequest $updateExpenseRequest,
        UpdateExpenseService $updateExpenseService,
        Expense              $expense
    ): JsonResponse
    {
        $data = $updateExpenseRequest->validated();
        $expense = $updateExpenseService->run($data, $expense);
        return response()->json([
            'status' => 'success',
            'message' => 'Despesa atualizada com sucesso',
            'data' => $expense
        ]);
    }

    public function destroy(
        DeleteExpenseService $deleteExpenseService,
        Expense              $expense
    ): JsonResponse
    {
        if ($expense->billsToPays()->count() > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Não foi possível apagar, contas a pagar vinculadas'
            ]);
        }

        $deleteExpenseService->run($expense);

        return response()->json([
            'status' => 'success',
            'message' => 'Despesa apagada com sucesso!'
        ]);
    }
}
