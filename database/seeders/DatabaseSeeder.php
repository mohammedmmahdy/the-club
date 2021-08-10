<?php

namespace Database\Seeders;

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
        $this->call([
            AdminsTableSeeder::class,
            RolesPermissionsTableSeeder::class,
            OptionTableSeeder::class,
            SliderTableSeeder::class,
            PageTableSeeder::class,
            InformationTableSeeder::class,
            SocialLinkTableSeeder::class,
        ]);
    }
}
