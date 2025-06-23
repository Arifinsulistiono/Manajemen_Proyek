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
            ['Paracetamol', 5000, 'Antipiretik & Analgesik', 'Menurunkan demam dan meredakan nyeri ringan hingga sedang.'],
            ['Ibuprofen', 7000, 'Antipiretik & Analgesik', 'Mengurangi nyeri, peradangan, dan demam.'],
            ['Asam Mefenamat', 6000, 'Antipiretik & Analgesik', 'Untuk mengatasi nyeri ringan hingga sedang, seperti nyeri haid atau sakit gigi.'],
            ['Natrium Diklofenak', 7000, 'Antipiretik & Analgesik', 'Meredakan peradangan dan nyeri otot/sendi.'],
            ['Panadol', 8500, 'Antipiretik & Analgesik', 'Meredakan nyeri dan menurunkan demam.'],
            ['Sanmol', 5000, 'Antipiretik & Analgesik', 'Obat penurun demam dan nyeri ringan.'],
            ['Paracetamol Forte', 7500, 'Antipiretik & Analgesik', 'Versi kuat dari paracetamol untuk nyeri yang lebih berat.'],

            ['Amoxicillin', 10000, 'Antibiotik', 'Mengobati infeksi bakteri seperti radang tenggorokan, ISPA.'],
            ['Erythromycin', 11000, 'Antibiotik', 'Antibiotik untuk infeksi saluran pernapasan dan kulit.'],
            ['Cefadroxil', 12000, 'Antibiotik', 'Infeksi saluran kemih dan kulit.'],
            ['Ciprofloxacin', 13000, 'Antibiotik', 'Antibiotik spektrum luas untuk berbagai infeksi.'],
            ['Metronidazole', 8000, 'Antibiotik', 'Mengatasi infeksi parasit dan bakteri anaerob.'],

            ['OBH Combi', 8000, 'Obat Batuk dan Flu', 'Meredakan batuk berdahak dan tenggorokan gatal.'],
            ['Woods', 9000, 'Obat Batuk dan Flu', 'Mengobati batuk berdahak dan iritasi tenggorokan.'],
            ['Komix', 5000, 'Obat Batuk dan Flu', 'Meredakan batuk kering dan berdahak.'],
            ['Decolgen', 6000, 'Obat Batuk dan Flu', 'Mengobati flu dan demam.'],
            ['Mixagrip', 6000, 'Obat Batuk dan Flu', 'Meringankan gejala flu dan pilek.'],
            ['Actifed', 7500, 'Obat Batuk dan Flu', 'Mengurangi pilek, batuk, dan alergi ringan.'],
            ['Demacolin', 6500, 'Obat Batuk dan Flu', 'Mengatasi pilek dan batuk.'],
            ['Procold', 7000, 'Obat Batuk dan Flu', 'Mengobati flu, demam, dan sakit kepala.'],
            ['Ultraflu', 7000, 'Obat Batuk dan Flu', 'Meringankan flu berat.'],
            ['OBH Ika', 6000, 'Obat Batuk dan Flu', 'Sirup batuk herbal.'],
            ['Neozep', 7000, 'Obat Batuk dan Flu', 'Meredakan gejala flu dan pilek.'],
            ['Konidin', 5000, 'Obat Batuk dan Flu', 'Obat batuk dan pilek.'],

            ['CTM', 3000, 'Antihistamin', 'Mengurangi alergi, gatal-gatal, dan pilek.'],
            ['Cetirizine', 5000, 'Antihistamin', 'Meredakan alergi dan gatal-gatal.'],
            ['Loratadine', 6000, 'Antihistamin', 'Mengobati alergi tanpa menyebabkan kantuk.'],

            ['Promag', 4000, 'Obat Lambung', 'Mengurangi asam lambung dan melindungi dinding lambung.'],
            ['Mylanta', 5000, 'Obat Lambung', 'Untuk sakit maag dan gangguan pencernaan.'],
            ['Ranitidine', 6000, 'Obat Lambung', 'Menurunkan produksi asam lambung.'],
            ['Omeprazole', 8000, 'Obat Lambung', 'Obat tukak lambung dan GERD.'],
            ['Antasida Doen', 4500, 'Obat Lambung', 'Netralisasi asam lambung berlebih.'],

            ['Enervon-C', 7000, 'Vitamin', 'Multivitamin untuk daya tahan tubuh.'],
            ['Fatigon', 6000, 'Vitamin', 'Menambah stamina dan mengatasi kelelahan.'],
            ['Imboost', 10000, 'Vitamin', 'Meningkatkan sistem imun.'],
            ['Becom-C', 8000, 'Vitamin', 'Vitamin B kompleks dan C untuk kekebalan.'],
            ['Zinc', 7500, 'Vitamin', 'Mineral penting untuk penyembuhan luka dan kekebalan.'],

            ['Antimo', 4000, 'Anti Mual & Mabuk', 'Mengatasi mabuk perjalanan.'],
            ['Loperamide', 5000, 'Obat Diare', 'Menghentikan diare dengan memperlambat gerakan usus.'],
            ['Entrostop', 4000, 'Obat Diare', 'Mengatasi diare dan menormalkan pencernaan.'],
            ['Diapet', 4500, 'Obat Diare', 'Obat herbal untuk diare.'],

            ['Dexamethasone', 6000, 'Anti Inflamasi & Alergi', 'Anti-inflamasi kuat untuk alergi dan peradangan.'],
            ['Hydrocortisone', 7500, 'Anti Inflamasi & Alergi', 'Salep untuk ruam, alergi kulit, dan peradangan.'],

            ['Betadine', 7000, 'Antiseptik', 'Obat luar antiseptik untuk luka.'],
            ['Minyak Kayu Putih', 4000, 'Obat Luar & Herbal', 'Menghangatkan tubuh, meredakan masuk angin.'],
            ['Vicks Vaporub', 5000, 'Obat Luar & Herbal', 'Digosokkan untuk melegakan pernapasan.'],
            ['Antangin', 4000, 'Obat Luar & Herbal', 'Mengatasi masuk angin dan mual.'],
            ['Tolak Angin', 5000, 'Obat Luar & Herbal', 'Obat herbal untuk masuk angin.'],
            ['Strepsils', 6000, 'Obat Tenggorokan', 'Meredakan sakit tenggorokan dan iritasi.'],
            ['Laserin', 6000, 'Obat Batuk dan Flu', 'Obat herbal untuk batuk kering dan berdahak.'],
            ['Tempra', 6500, 'Antipiretik & Analgesik', 'Obat sirup penurun panas untuk anak.'],
            ['Inza', 5500, 'Obat Batuk dan Flu', 'Mengurangi gejala flu dan demam.'],
        ];

        $obats = [];

        foreach ($obatList as [$nama, $harga, $kategori, $deskripsi]) {
            $obats[] = [
                'nama' => $nama,
                'harga' => $harga,
                'kategori' => $kategori,
                'deskripsi' => $deskripsi,
                'status' => $statusOptions[array_rand($statusOptions)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('obats')->insert($obats);
    }
}