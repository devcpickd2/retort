<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'uuid'              => (string) Str::uuid(),
                'username'          => 'admin',
                'plant'             => 'HQ',
                'department'        => 'IT',
                'type_user'         => 'admin',
                'photo'             => null,
                'name'              => 'Administrator',
                'email'             => 'admin@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'), // default password
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
                'activation'        => 1,
                'updater'           => null,
            ],
            [
                'uuid'              => (string) Str::uuid(),
                'username'          => 'user1',
                'plant'             => 'PLANT-01',
                'department'        => 'Finance',
                'type_user'         => 'user',
                'photo'             => null,
                'name'              => 'User One',
                'email'             => 'user1@example.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('password'),
                'remember_token'    => Str::random(10),
                'created_at'        => now(),
                'updated_at'        => now(),
                'activation'        => 1,
                'updater'           => null,
            ]
        ]);
    }
}