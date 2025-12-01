<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Matikan FK sementara (untuk aman kalau ada relasi)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus seluruh data
        DB::table('users')->truncate();

        // Nyalakan kembali FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $user1 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'superadmin',
            'plant' => 'fdaca613-7ab2-4997-8f33-686e886c867d',
            'department' => 1,
            'type_user' => 0,
            'photo' => null,
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('cpi12345'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'activation' => 1,
            'updater' => null
        ]);

        $user2 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'admin',
            'plant' => 'fdaca613-7ab2-4997-8f33-686e886c867d',
            'department' => 1,
            'type_user' => 1,
            'photo' => null,
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('cpi12345'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'activation' => 1,
            'updater' => null
        ]);

        $user1->syncRoles('superadmin');
        $user2->syncRoles('admin');
    }
}
