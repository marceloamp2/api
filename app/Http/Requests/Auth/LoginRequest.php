<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string',],
            'password' => ['required', 'string',],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $user = User::where('email', $this->email)->first();

            if ($user) {
                if (!Hash::check($this->password, $user->password)) {
                    $validator->errors()->add('login', 'Senha incorreta');
                }
            } else {
                $validator->errors()->add('login', 'Usuário não encontrado');
            }
        });
    }
}
