<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dokter;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_appointment()
    {
        $dokter = Dokter::create([
            'nama' => 'Dr. Andi',
            'harga_jasa' => 50000
        ]);

        $response = $this->post('/appointment', [
            'nama' => 'Pasien A',
            'email' => 'pasien@test.com',
            'no_hp' => '08123456789',
            'dokter_id' => $dokter->id
        ]);

        $response->assertStatus(302);

    }
}
