<?php

namespace Database\Factories;

use App\Models\Academy;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Academy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon'       => 'icon.png',
            'main_photo' => 'image.jpg',
            'web_main_photo' => 'image.jpg',
            'en' => [ 'name' => $this->faker->sentence(3), 'about' => $this->faker->paragraph(10),'team' => $this->faker->paragraph(10),],
            'ar' => [ 'name' => $this->faker->sentence(3), 'about' => $this->faker->paragraph(10),'team' => $this->faker->paragraph(10),],
        ];
    }
}
