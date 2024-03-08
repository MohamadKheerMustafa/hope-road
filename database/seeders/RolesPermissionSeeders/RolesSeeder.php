<?php

namespace Database\Seeders\RolesPermissionSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [
                'name' => 'SuperAdmin',
                'guard_name' => 'web'
            ]
        ];
        $Permissions = Permission::all();
        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($Permissions);
    }
}
