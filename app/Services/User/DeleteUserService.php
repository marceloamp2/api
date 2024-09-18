<?php

namespace App\Services\User;

class DeleteUserService
{
    public function run(object $user): bool
    {
        return $user->delete();
    }
}
