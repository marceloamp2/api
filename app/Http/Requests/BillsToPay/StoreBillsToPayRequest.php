<?php

namespace App\Http\Requests\BillsToPay;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillsToPayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'due_date' => ['required', 'date_format:Y-m-d'],
            'payday' => ['nullable', 'date_format:Y-m-d'],
            'value' => ['required', 'string', 'numeric'],
            'note' => ['required', 'string'],
            'payment_method_id' => ['nullable', 'integer', 'exists:payment_methods,id'],
            'expense_id' => ['nullable', 'integer', 'exists:expenses,id'],
        ];
    }
}
