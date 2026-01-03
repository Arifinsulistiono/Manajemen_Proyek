<?php

use App\Models\Dokter;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('homepage shows doctor list', function () {
    Dokter::create([
        'nama' => 'Dr. Andi',
        'spesialis' => 'Umum',
        'harga_jasa' => 50000
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Dr. Andi');
});
