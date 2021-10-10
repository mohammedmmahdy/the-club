<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();


        for ($i=1; $i <= 10 ; $i++) {
            Event::create([
                'date' => date(rand(1632996259,1664532259)),
                'icon' => 'icon.png',
                'photo' => 'image.jpg',
                'members_only' => rand(0,1),
                'en' => ['title' => $faker->sentence(3), 'description' => $faker->paragraph(10)],
                'ar' => ['title' => $faker->sentence(3), 'description' => $faker->paragraph(10)],
            ]);
        }
    }
}
