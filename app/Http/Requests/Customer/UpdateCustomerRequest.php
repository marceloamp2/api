<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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

        if ($this->route()->customer->naturalPerson) {
            $rules = [
                'customer.phone' => ['nullable', 'string'],
                'customer.cellphone' => ['required', 'string'],
                'customer.email' => ['nullable', 'email'],
                'natural_person.name' => ['required', 'string'],
                'natural_person.cpf' => [
                    'required',
                    'string',
                    Rule::unique('natural_people', 'cpf')->ignore($this->route()->customer->naturalPerson->cpf, 'cpf')
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

        if ($this->route()->customer->legalPerson) {
            $rules = [
                'customer.phone' => ['nullable', 'string'],
                'customer.cellphone' => ['required', 'string'],
                'customer.email' => ['nullable', 'email'],
                'legal_person.cnpj' => [
                    'required',
                    'string',
                    Rule::unique('legal_people', 'cnpj')->ignore($this->route()->customer->legalPerson->cnpj, 'cnpj')
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
