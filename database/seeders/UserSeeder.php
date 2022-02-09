<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin1',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'id_outlet' => 1,
                'role' => 'admin'
            ],
            [
                'name' => 'Owner',
                'username' => 'owner1',
                'email' => 'owner@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'id_outlet' => 1,
                'role' => 'owner'
            ],
            [
                'name' => 'Kasir',
                'username' => 'kasir1',
                'email' => 'kasir@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('a'),
                'remember_token' => Str::random(10),
                'id_outlet' => 1,
                'role' => 'kasir'
            ]
        ];
        DB::table('users')->insert($users);
    }
}
