<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PaymentMethod\IndexPaymentMethodService;
use Illuminate\Http\JsonResponse;

class PaymentMethodController extends Controller
{
    public function index(
        IndexPaymentMethodService $indexPaymentMethodService
    ): JsonResponse
    {
        $paymentMethods = $indexPaymentMethodService->run();
        return response()->json($paymentMethods);
    }
}
