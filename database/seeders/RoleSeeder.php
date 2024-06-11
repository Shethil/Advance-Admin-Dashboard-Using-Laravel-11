<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an admin role & assing all permission

        $adminPermissions = Permission::select('id')->get();

        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'admin has all permission',
            'is_deleteable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        // create a user role
        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'user has limited permission',
            'is_deleteable' => true,
        ]);
    }
}
