<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function isAdminCanViewLoginForm()
    {
        $response = $this->get(route('adminPanel.login'));

        $response->assertStatus(200);
    }

    /** @test */
    public function isAdminCanLogin()
    {
        $response = Admin::create([
            'email' => 'test@admin.com',
            'password' => Hash::make('testadmin'),
            'name' => 'Test Admin',
        ]);

        $response->assertStatus(200)->dump();


    }


}
