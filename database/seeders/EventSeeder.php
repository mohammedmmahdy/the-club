<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventReservation;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()authcon
    {
        $faker = \Faker\Factory::create();

// Create Events
        for ($i=1; $i <= 10 ; $i++) {
            Event::create([
                'branch_id' => 1,
                'date' => date(rand(1632996259,1664532259)),
                'icon' => 'icon.png',
                'photo' => 'image.jpg',
                'members_only' => rand(0,1),
                'en' => ['title' => $faker->sentence(3), 'description' => $faker->paragraph(10)],
                'ar' => ['title' => $faker->sentence(3), 'description' => $faker->paragraph(10)],
            ]);
        }

// Create Event Reservations
        for ($i=1; $i <= 20 ; $i++) {
            EventReservation::create([
                'event_id' => rand(1,10),
                'user_id' => rand(1,10),

                'first_name' => $faker->firstName,
                'last_name'=> $faker->lastName,
                'phone' => $faker->e164PhoneNumber,
                'number_of_tickets' => rand(1,10),
            ]);
        }
    }
}
