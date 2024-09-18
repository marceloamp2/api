<?php

namespace App\Http\Requests\StockMovement;

use App\Models\Input;
use App\Models\Stock;
use Illuminate\Foundation\Http\FormRequest;

class StoreStockMovementRequest extends FormRequest
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
            'type' => ['required', 'string', 'in:in,out'],
            'total_value' => ['required_if:type,in', 'numeric'],
            'nf_number' => ['required_if:type,in', 'string'],
            'supplier_id' => ['required_if:type,in', 'integer', 'exists:suppliers,id'],
            'inputs' => ['required', 'array'],
            'inputs.*.input_id' => ['required', 'integer', 'exists:inputs,id'],
            'inputs.*.quantity' => ['required', 'integer', 'min:1'],
            'inputs.*.unitary_value' => ['required_if:type,in', 'numeric'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->type === 'out') {
                foreach ($this->inputs as $key => $input) {
                    $quantityInStock = Stock::where('input_id', $input['input_id'])->value('quantity');
                    $inputInDatabase = Input::find($input['input_id']);

                    if ($quantityInStock < $input['quantity']) {
                        $validator->errors()->add(
                            "quantity_$key", "Quantidade insuficiente no estoque do insumo: $inputInDatabase->name"
                        );
                    }
                }
            }
        });
    }
}
