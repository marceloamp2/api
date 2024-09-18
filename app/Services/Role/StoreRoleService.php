<?php

namespace App\Services\Role;

use App\Models\Role;

class StoreRoleService
{
    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function run(array $data): object
    {
        return $this->role->create($data);
    }
}
