<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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

        if ($this->supplier['person_type'] === 'pf') {
            $rules = [
                'supplier.person_type' => ['required', 'string', 'in:pf,pj'],
                'supplier.phone' => ['nullable', 'string'],
                'supplier.cellphone' => ['required', 'string'],
                'supplier.email' => ['required', 'string', 'email'],
                'natural_person.name' => ['required_if:supplier.person_type,pf', 'string'],
                'natural_person.cpf' => ['required_if:supplier.person_type,pf', 'string', 'unique:natural_people,cpf'],
                'address.zipcode' => ['required', 'string'],
                'address.address' => ['required', 'string'],
                'address.number' => ['required', 'string'],
                'address.complement' => ['nullable', 'string'],
                'address.neighborhood' => ['required', 'string'],
                'address.city' => ['required', 'string'],
                'address.state' => ['required', 'string'],
            ];
        }

        if ($this->supplier['person_type'] === 'pj') {
            $rules = [
                'supplier.person_type' => ['required', 'string', 'in:pf,pj'],
                'supplier.phone' => ['nullable', 'string'],
                'supplier.cellphone' => ['required', 'string'],
                'supplier.email' => ['required', 'string', 'email'],
                'legal_person.cnpj' => ['required_if:supplier.person_type,pj', 'string', 'unique:legal_people,cnpj'],
                'legal_person.company' => ['required_if:supplier.person_type,pj', 'string'],
                'legal_person.trade' => ['required_if:supplier.person_type,pj', 'string'],
                'legal_person.contact' => ['required_if:supplier.person_type,pj', 'string'],
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
