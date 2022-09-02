<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminAuthTest extends TestCase
{
    public function test_auth_login_fail_validation()
    {
        $response = $this->postJson('/management/auth/login', [
            'username' => '',
            'password' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_auth_login_fail()
    {
        $admin = Admin::factory()->make();

        $response = $this->postJson('/management/auth/login', [
            'username' => $admin->username,
            'password' => $admin->password,
        ]);

        $response->assertStatus(422);
    }

    public function test_auth_login_successful()
    {
        $admin = Admin::factory()->create();

        $response = $this->postJson('/management/auth/login', [
            'username' => $admin->username,
            'password' => 'password',
        ]);

        $response->assertOk();
    }
}
