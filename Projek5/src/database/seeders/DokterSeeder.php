<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dokters')->insert([
            [
                'nama' => 'Dr. Muhammad Arifin',
                'spesialis' => 'Umum',
                'foto' => 'assets/klinik/img/Arifin.jpg',
                'harga_jasa' => 50000,
            ],
            [
                'nama' => 'Dr. Rizky Dwi',
                'spesialis' => 'Umum',
                'foto' => 'assets/klinik/img/Rizky.jpg',
                'harga_jasa' => 60000,
            ],
            [
                'nama' => 'Dr. Putra Daffa',
                'spesialis' => 'Umum',
                'foto' => 'assets/klinik/img/Putra.jpg',
                'harga_jasa' => 55000,
            ],
        ]);
    }
}