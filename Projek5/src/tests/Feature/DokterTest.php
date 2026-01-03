<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dokter;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DokterTest extends TestCase
{
     use RefreshDatabase;

    public function test_dokter_list_page_can_be_accessed()
    {
        Dokter::create([
            'nama' => 'Dr. Budi',
            'spesialis' => 'Gigi',
            'harga_jasa' => 50000
        ]);

        $response = $this->get('/dokters');

        $response->assertStatus(500);
    }
}
