<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Permission\IndexPermissionService;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    public function index(
        IndexPermissionService $indexPermissionService
    ): JsonResponse
    {
        $expenses = $indexPermissionService->run();
        return response()->json($expenses);
    }
}
