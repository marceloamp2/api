<?php

namespace App\Http\Requests\BillsToPay;

use Illuminate\Foundation\Http\FormRequest;

class IndexBillsToPayRequest extends FormRequest
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
            'paginate' => ['nullable', 'string', 'in:true,false'],
        ];
    }
}
