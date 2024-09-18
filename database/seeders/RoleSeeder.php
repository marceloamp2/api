<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Administrador',
            ],
            [
                'name' => 'Recepcionista',
            ],
        ]);

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                [
                    'permission_id' => $permission->id,
                    'role_id' => 1,
                ],
            ]);
        }
    }
}
