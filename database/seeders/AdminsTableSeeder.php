<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('admins')->first()) {
            DB::table('admins')->insert([
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'approved_at' => now(),
            ]);
        }
    }
}
