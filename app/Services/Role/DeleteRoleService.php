<?php

namespace App\Services\Role;

class DeleteRoleService
{
    public function run(object $role): bool
    {
        return $role->delete();
    }
}
