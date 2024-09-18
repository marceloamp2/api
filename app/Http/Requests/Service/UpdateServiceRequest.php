<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'service.name' => ['required', 'string'],
            'service.status' => ['required', 'string', 'in:active,inactive'],
            'service_value_ranges' => ['required', 'array'],
            'service_value_ranges.*.from' => ['required', 'integer'],
            'service_value_ranges.*.to' => ['required', 'integer'],
            'service_value_ranges.*.unitary_value' => ['required', 'numeric'],
        ];
    }
}
