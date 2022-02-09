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
        $this->call(UserSeeder::class);
        //\App\Models\User::factory(10)->create();
        \App\Models\Member::factory(50)->create();

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
