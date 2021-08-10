<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'photo' => 'slider_1.jpg',
                'link' => '#',
                'status' => 1,
                'en' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
                'ar' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
            ],
            [
                'photo' => 'slider_2.jpg',
                'link' => '#',
                'status' => 1,
                'en' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
                'ar' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
            ],
            [
                'photo' => 'slider_3.jpg',
                'link' => '#',
                'status' => 1,
                'en' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
                'ar' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
            ],
            [
                'photo' => 'slider_4.jpg',
                'link' => '#',
                'status' => 1,
                'en' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
                'ar' => [
                    'title' => 'Earn. Connect. Contribute to Socity',
                    'subtitle' => 'Partner with us to drive your own livelihood and more.',
                    'button_text' => 'Sign up Now',
                ],
            ],


        ];


        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
