<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
   use RefreshDatabase;

    public function test_filament_login_page_can_be_opened()
    {
        $response = $this->get('/dashboard/login');

        $response->assertStatus(200);
    }

}
