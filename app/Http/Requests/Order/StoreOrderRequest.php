<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'total_value' => ['required', 'numeric', 'min:1'],
            'sedex' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'note' => ['nullable', 'string'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'payment_method_id' => ['required', 'integer', 'exists:payment_methods,id'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'projects' => ['required', 'array'],
            'projects.*.brand' => ['required', 'string'],
            'projects.*.services' => ['required', 'array'],
            'projects.*.services.*.id' => ['required', 'integer', 'exists:services,id'],
            'projects.*.services.*.quantity' => ['required', 'numeric', 'min:1'],
            'projects.*.images.*' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^data:image\/(\w+);base64,/', $value)) {
                    $fail($attribute . ' não é uma imagem base64 válida.');
                }
            }],
        ];
    }
}
