<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSupplierRequest extends FormRequest
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
        $rules = [];

        if ($this->route()->supplier->naturalPerson) {
            $rules = [
                'supplier.phone' => ['nullable', 'string'],
                'supplier.cellphone' => ['required', 'string'],
                'supplier.email' => ['required', 'string', 'email'],
                'natural_person.name' => ['required', 'string'],
                'natural_person.cpf' => [
                    'required',
                    'string',
                    Rule::unique('natural_people', 'cpf')->ignore($this->route()->supplier->naturalPerson->cpf, 'cpf')
                ],
                'address.zipcode' => ['required', 'string'],
                'address.address' => ['required', 'string'],
                'address.number' => ['required', 'string'],
                'address.complement' => ['nullable', 'string'],
                'address.neighborhood' => ['required', 'string'],
                'address.city' => ['required', 'string'],
                'address.state' => ['required', 'string'],
            ];
        }

        if ($this->route()->supplier->legalPerson) {
            $rules = [
                'supplier.phone' => ['nullable', 'string'],
                'supplier.cellphone' => ['required', 'string'],
                'supplier.email' => ['required', 'string', 'email'],
                'legal_person.cnpj' => [
                    'required',
                    'string',
                    Rule::unique('legal_people', 'cnpj')->ignore($this->route()->supplier->legalPerson->cnpj, 'cnpj')
                ],
                'legal_person.company' => ['required', 'string'],
                'legal_person.trade' => ['required', 'string'],
                'legal_person.contact' => ['required', 'string'],
                'address.zipcode' => ['required', 'string'],
                'address.address' => ['required', 'string'],
                'address.number' => ['required', 'string'],
                'address.complement' => ['nullable', 'string'],
                'address.neighborhood' => ['required', 'string'],
                'address.city' => ['required', 'string'],
                'address.state' => ['required', 'string'],
            ];
        }

        return $rules;
    }
}
