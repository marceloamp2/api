<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LegalPerson\SearchByCnpjRequest;
use App\Services\LegalPerson\SearchByCnpjService;
use Illuminate\Http\JsonResponse;

class LegalPersonController extends Controller
{
    public function searchByCnpj(
        SearchByCnpjRequest $searchByCnpjRequest,
        SearchByCnpjService $searchByCnpjService
    ): JsonResponse
    {
        $data = $searchByCnpjRequest->validated();
        $legalPerson = $searchByCnpjService->run($data['cnpj']);
        return response()->json($legalPerson);
    }
}
