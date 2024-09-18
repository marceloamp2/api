<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route()->user)],
            'password' => ['nullable', 'confirmed'],
            'status' => ['required', 'string', 'in:active,inactive'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ];
    }
}
