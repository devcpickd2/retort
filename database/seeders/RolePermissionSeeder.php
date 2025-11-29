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
            'can access add button',
            'can access edit button',
            'can access update button',
            'can access delete button',
            'can access verification button',
            'can access master data',
            'can access control',
            'can access form qc'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Role
        $admin = Role::firstOrCreate(['name' => 'superadmin']);
        $staff = Role::firstOrCreate(['name' => 'admin']);

        // Assign permission ke role
        $admin->givePermissionTo($permissions); // semua
        $staff->givePermissionTo(['can access master data','can access form qc']); // hanya ini
    }
}
