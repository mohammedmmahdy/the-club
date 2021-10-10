<?php

namespace Database\Seeders;


use App\Models\Academy;
use App\Models\AcademyPhoto;
use App\Models\AcademySchedule;
use Illuminate\Database\Seeder;
use App\Models\AcademySubscription;

class AcademySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create();

        Academy::factory()->count(5)->create();

        // Academy Photos
        for ($i= 1; $i <= 5; $i++) {
            AcademyPhoto::create(['academy_id' => $i, 'photo' => 'image.jpg']);
            AcademyPhoto::create(['academy_id' => $i, 'photo' => 'image.jpg']);
            AcademyPhoto::create(['academy_id' => $i, 'photo' => 'image.jpg']);
            AcademyPhoto::create(['academy_id' => $i, 'photo' => 'image.jpg']);
            AcademyPhoto::create(['academy_id' => $i, 'photo' => 'image.jpg']);
        }

        // Academy Schedule
        for ($i= 1; $i <= 5; $i++) {
            AcademySchedule::create(['academy_id' => $i, 'day' => 'SUN', 'from' => '11:00:00', 'to' => '01:00:00']);
            AcademySchedule::create(['academy_id' => $i, 'day' => 'SUN', 'from' => '14:00:00', 'to' => '17:00:00']);
            AcademySchedule::create(['academy_id' => $i, 'day' => 'WED', 'from' => '11:00:00', 'to' => '01:00:00']);
            AcademySchedule::create(['academy_id' => $i, 'day' => 'WED', 'from' => '14:00:00', 'to' => '17:00:00']);
        }

        // Academy Requests
        for ($i = 0; $i < 20; $i++) {
            AcademySubscription::create([
                'academy_id' => rand(1, 5),
                'user_id' => rand(1, 10),
                'academy_schedule_id' => rand(1, 10),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'phone' => $faker->e164PhoneNumber(),
                'age' => rand(8, 30),
                'gender' => rand(1, 2), // 1 => Male, 2 => Female
            ]);
        }

    }
}
