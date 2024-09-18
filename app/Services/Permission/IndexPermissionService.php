<?php

namespace App\Services\Permission;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class IndexPermissionService
{
    private Permission $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function run(): Collection
    {
        return $this->permission->get()->groupBy('group');
    }
}
