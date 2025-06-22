<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Lokal Faker Indonesia
        $appointments = [];

        foreach (range(1, 50) as $i) {
            $appointments[] = [
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'mobile' => '08' . $faker->numerify('##########'), // nomor Indonesia 08xxxxxxxxxx
                'date' => $faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
                'time' => $faker->time('H:i:s'),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('appointments')->insert($appointments);
    }
}
