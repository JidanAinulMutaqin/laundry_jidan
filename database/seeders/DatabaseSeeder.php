<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(50)->create();
        \App\Models\Member::factory(10)->create();
        \App\Models\Outlet::factory(10)->create();
        \App\Models\Paket::factory(10)->create();
        $this->call(UserSeeder::class);

        // User::create([
        //     'name' => 'Jidan Ainul Mutaqin',
        //     'username' => 'Jidan AM',
        //     'email' => 'zjidan12345@gmail.com',
        //     'password' => bcrypt('12345678'),
        //     'id_outlet' => '1',
        //     'role' => 'admin'
        // ]);
    }
}
