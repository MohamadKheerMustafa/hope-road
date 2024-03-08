<?php

namespace Database\Seeders\RolesPermissionSeeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            [
                'name' => 'role-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'role-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'task-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'task-update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'task-delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'task-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'report-update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'report-delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'report-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manageEmployees-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manageEmployees-update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manageEmployees-delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manageEmployees-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'services-create',
                'guard_name' => 'web'
            ],
            [
                'name' => 'services-update',
                'guard_name' => 'web'
            ],
            [
                'name' => 'services-delete',
                'guard_name' => 'web'
            ],
            [
                'name' => 'services-list',
                'guard_name' => 'web'
            ],
            [
                'name' => 'ticket-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'visa',
                'guard_name' => 'web'
            ],
            [
                'name' => 'hotel-booking',
                'guard_name' => 'web'
            ],
            [
                'name' => 'insurance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'domestic-flights',
                'guard_name' => 'web'
            ],
            [
                'name' => 'university-acceptance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'tourist-services',
                'guard_name' => 'web'
            ],
            [
                'name' => 'foreign-flights',
                'guard_name' => 'web'
            ],

        ];
        foreach ($array as $Permissions) {
            Permission::create($Permissions);
        }
    }
}
