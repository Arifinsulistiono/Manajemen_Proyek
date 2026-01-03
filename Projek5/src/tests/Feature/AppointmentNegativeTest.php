<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentNegativeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function appointment_creation_fails_when_required_data_missing()
    {
        $response = $this->post('/appointment', [
            // sengaja dikosongkan
        ]);

        $response->assertStatus(302); // redirect karena validasi gagal
        $response->assertSessionHasErrors();
    }
}