<?php

namespace App\Services\ResetPassword;

use Illuminate\Support\Facades\Password;

class SendLinkResetPasswordService
{
    public function run(string $email): array|string
    {
        $status = Password::sendResetLink([
            'email' => $email,
        ]);

        if ($status !== Password::RESET_LINK_SENT) {
            return [
                'errors' => [
                    'title' => $status,
                ],
            ];
        }

        return $status;
    }
}
