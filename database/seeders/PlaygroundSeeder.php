<?php

namespace Database\Seeders;

use App\Models\Playground;
use App\Models\PlaygroundReservation;
use App\Models\PlaygroundType;
use Illuminate\Database\Seeder;

class PlaygroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        PlaygroundType::create(
            [
                'en' => ['name' => 'Football'],
                'ar' => ['name' => 'Football'],
            ],
        );

        PlaygroundType::create(
            [
                'en' => ['name' => 'Basketball'],
                'ar' => ['name' => 'Basketball'],
            ],
        );

        PlaygroundType::create(
            [
                'en' => ['name' => 'Tennis'],
                'ar' => ['name' => 'Tennis'],
            ],
        );



        // Playgrounds

        for ($i = 1; $i <= 10; $i++) {
            Playground::create([
                'en' => ['name' => 'Playground ' . $i, 'description' => $faker->paragraph(10)],
                'ar' => ['name' => 'Playground ' . $i, 'description' => $faker->paragraph(10)],
                'branch_id' => 1,
                'playground_type_id' => rand(1, 3),
                'price' => rand(200,300),
            ]);
        }

        // Create Playground Reservations
        for ($i=1; $i <= 20 ; $i++) {
            PlaygroundReservation::create([
                'playground_id' => rand(1,10),
                'user_id' => rand(1,10),

                'first_name' => $faker->firstName,
                'last_name'=> $faker->lastName,
                'phone' => $faker->e164PhoneNumber,
                'date' => $faker->date,
                'time' => $faker->time,
                'number_of_people' => rand(8,12),
                'price' => rand(200,300),
            ]);


        }
    }
}
