<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NaturalPerson\SearchByCpfRequest;
use App\Services\NaturalPerson\SearchByCpfService;
use Illuminate\Http\JsonResponse;

class NaturalPersonController extends Controller
{
    public function searchByCpf(
        SearchByCpfRequest $searchByCpfRequest,
        SearchByCpfService $searchByCpfService
    ): JsonResponse
    {
        $data = $searchByCpfRequest->validated();
        $naturalPerson = $searchByCpfService->run($data['cpf']);
        return response()->json($naturalPerson);
    }
}
