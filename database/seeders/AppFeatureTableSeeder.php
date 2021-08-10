<?php

namespace Database\Seeders;

use App\Models\AppFeature;
use Illuminate\Database\Seeder;

class AppFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appFeatures = [
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Fast & Powerful',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Fast & Powerful',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Easily Editable',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Easily Editable',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Cloud Storage',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Cloud Storage',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Easy Notifications',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Easy Notifications',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Fully Responsive',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Fully Responsive',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],
            [
                'icon' => 'fas fa-rocket',
                'en' => [
                    'text' => 'Editable Layout',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
                'ar' => [
                    'text' => 'Editable Layout',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                ],
            ],


        ];


        foreach ($appFeatures as $appFeature) {
            AppFeature::create($appFeature);
        }
    }
}
