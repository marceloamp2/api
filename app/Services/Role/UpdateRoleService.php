<?php

namespace App\Services\Role;

class UpdateRoleService
{
    public function run(array $data, object $role): object
    {
        $role->update($data);
        return $role;
    }
}
