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
            'branch_id' => 1,
            'name' => $this->faker->sentence(3),
            'about' => $this->faker->sentence(100),
            'team' => $this->faker->sentence(100),
            'icon' => 'icon.png'
        ];
    }
}
