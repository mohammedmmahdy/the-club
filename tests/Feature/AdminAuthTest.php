<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        $admin = Admin::create([
            'email' => 'test@admin.com',
            'password' => Hash::make('testadmin'),
            'name' => 'Test Admin',
        ]);

        $this->assertDatabaseHas('admins', [
            'email' => 'test@admin.com',
        ]);

        $response = Auth::guard('admin')->attempt([
            'email' => 'test@admin.com',
            'password' => 'testadmin',
        ]);
        $this->actingAs($admin);

    }


}
