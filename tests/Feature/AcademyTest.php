<?php

namespace Tests\Feature;

use App\Models\Academy;
use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyTest extends TestCase
{
    use WithFaker;

    // use RefreshDatabase;
    /** @test */
    public function itCreateAcademy()
    {
        // $this->withoutExceptionHandling();

        $admin = Admin::find(1);
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('adminPanel.academies.store'), [
            'en' => [
                'name'      => 'test name',
                'about'     => 'test about',
                'team'      => 'test team',
            ],
            'ar' => [
                'name'      => 'test name',
                'about'     => 'test about',
                'team'      => 'test team',
            ],
            // 'photos' => [
            //     'photo' => $this->faker()->image(),
            // ],

            // 'time' => [
            //     'day'   => 'SUN',
            //     'from'  => '09:50 pm',
            //     'to'    => '12:50 pm',
            // ],
            'branch_id' => 1,
            'icon'      => 'icon.png',
        ]);

        $response->assertCreated();

    }
}
