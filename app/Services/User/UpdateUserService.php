<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Hash;

class UpdateUserService
{
    public function run(array $data, object $user): object
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return $user;
    }
}
