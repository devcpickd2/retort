<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permission
        $permissions = [
            'manage users',
            'view reports',
            'edit articles',
            'delete articles',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Role
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        // Assign permission ke role
        $admin->givePermissionTo($permissions); // semua
        $staff->givePermissionTo(['view reports']); // hanya ini
    }
}
