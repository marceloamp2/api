<?php

namespace App\Services\Role;

use App\Models\Role;

class AddPermissionsService
{
    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function run(array $data)
    {
        $role = $this->role->find($data['role_id']);
        $role->permissions()->sync($data['permissions']);
        return $role->load('permissions');
    }
}
