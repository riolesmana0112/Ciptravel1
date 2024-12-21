<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Foreach_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'admin'],
            ['role_name' => 'driver']
        ];

        foreach ($roles as $role) {
            Role::create([
                'role_name' => $role['role_name']
            ]);
        }

        $user = [
            'name' => 'Admin',
            'username' => 'ciptaindonesia',
            'password' => Hash::make('123456789'),
            'email' => 'admin@ciptaindonesia.com',
        ];

        $admin = User::create([
            'name' => $user['name'],
            'username' => $user['username'],
            'password' => $user['password'],
            'email' => $user['email'],
        ]);

        $role = Role::whereRoleName('admin')->first();

        RoleUser::create([
            'user_id' => $admin->id,
            'role_id' => $role->id
        ]);
    }
}
