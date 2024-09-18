<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'filters.search' => ['nullable', 'string'],
            'filters.status' => ['nullable', 'array', 'in:active,inactive'],
            'paginate' => ['nullable', 'string', 'in:true,false'],
        ];
    }
}
