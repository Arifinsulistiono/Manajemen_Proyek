<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusOptions = ['Sebelum Makan', 'Sesudah Makan'];

        $obatList = [
            'Paracetamol', 'Bodrex', 'Antimo', 'Betadine', 'OBH Combi', 'Panadol', 'Neozep', 'Amoxicillin',
            'Sanmol', 'Promag', 'Paramex', 'Mixagrip', 'Decolgen', 'CTM', 'Actifed', 'Tempra',
            'Entrostop', 'Diapet', 'Antangin', 'Minyak Kayu Putih', 'Vicks Vaporub', 'Inza', 'Konidin',
            'Woods', 'Strepsils', 'Tolak Angin', 'Mylanta', 'Komix', 'Laserin', 'Demacolin', 'Procold',
            'Ultraflu', 'OBH Ika', 'Enervon-C', 'Fatigon', 'Imboost', 'Zinc', 'Dexamethasone',
            'Hydrocortisone', 'Loperamide', 'Cetirizine', 'Ranitidine', 'Antasida Doen', 'Ibuprofen',
            'Paracetamol Forte', 'Becom-C', 'Omeprazole', 'Salbutamol', 'Erythromycin'
        ];

        $obats = [];

        foreach ($obatList as $nama) {
            $obats[] = [
                'nama' => $nama,
                'harga' => rand(5, 100) * 1000,
                'status' => $statusOptions[array_rand($statusOptions)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('obats')->insert($obats);
    }
}
