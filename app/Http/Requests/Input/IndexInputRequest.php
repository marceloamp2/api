<?php

namespace App\Http\Requests\Input;

use Illuminate\Foundation\Http\FormRequest;

class IndexInputRequest extends FormRequest
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
            'paginate' => ['nullable', 'string', 'in:true,false'],
        ];
    }
}
