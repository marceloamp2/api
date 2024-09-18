<?php

namespace App\Services\ResetPassword;

use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordService
{
    public function run(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
            'token' => $data['token'],
        ];

        return Password::reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                $user->setRememberToken(Str::random(60));
                $user->update([
                    'last_reset_password_at' => Carbon::now(),
                ]);
                event(new PasswordReset($user));
            }
        );
    }
}
