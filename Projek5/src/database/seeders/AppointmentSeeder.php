<?php

namespace Database\Seeders;

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
        $faker = Faker::create('id_ID');
        $appointments = [];

        foreach (range(1, 50) as $i) {
            $nama = $faker->name;
            $namaEmail = strtolower(str_replace(' ', '', $nama));
            $randomNumber = $faker->unique()->numerify('###');
            $email = "{$namaEmail}{$randomNumber}@gmail.com";

            $appointments[] = [
                'nama' => $nama,
                'email' => $email,
                'mobile' => '08' . $faker->numerify('#########'), // 11–12 digit
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