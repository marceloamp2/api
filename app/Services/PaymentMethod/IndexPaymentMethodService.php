<?php

namespace App\Services\PaymentMethod;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

class IndexPaymentMethodService
{
    private PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function run(): Collection
    {
        return $this->paymentMethod->all();
    }
}
