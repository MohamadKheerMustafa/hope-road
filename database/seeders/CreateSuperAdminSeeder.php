<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::all();
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@hoperoad.com',
            'phone' => '0931443885',
            'password' => Hash::make('Mm1230123@'),
        ]);
        $user->assignRole($role);
    }
}
