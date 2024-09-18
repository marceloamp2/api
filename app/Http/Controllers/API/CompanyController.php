<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Company\IndexCompanyService;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function index(IndexCompanyService $indexCompanyService): JsonResponse
    {
        $companies = $indexCompanyService->run();
        return response()->json($companies);
    }
}
