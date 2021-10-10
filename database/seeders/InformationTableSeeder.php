<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Seeder;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $informations = [
            [
                'status' => 1,
                'en' => ['name' => 'phone', 'value' => '+201156215932'],
                'ar' => ['name' => 'phone', 'value' => '+201156215932'],
            ],
            [
                'status' => 1,
                'en' => ['name' => 'email', 'value' => 'info@email.com'],
                'ar' => ['name' => 'email', 'value' => 'info@email.com'],
            ],
            [
                'status' => 1,
                'en' => ['name' => 'address', 'value' => 'QFC Tower 1, No.98 Office: 8, Level 1. Doha, Qatar'],
                'ar' => ['name' => 'address', 'value' => 'QFC Tower 1, No.98 Office: 8, Level 1. Doha, Qatar'],
            ],
        ];

        foreach ($informations as $information) {
            Information::create($information);
        }
    }
}
