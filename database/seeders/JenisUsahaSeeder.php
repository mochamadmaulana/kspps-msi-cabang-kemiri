<?php

namespace Database\Seeders;

use App\Models\JenisUsaha;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisUsaha::insert([
            [
                'kode' => 'TN',
                'nama' => 'Tani'
            ],
            [
                'kode' => 'TNK',
                'nama' => 'Ternak'
            ],
            [
                'kode' => 'DhTN',
                'nama' => 'Dagang Hasil Pertanian'
            ],
            [
                'kode' => 'DhTNK',
                'nama' => 'Dagang Hasil Peternakan'
            ],
            [
                'kode' => 'NL',
                'nama' => 'Nelayan'
            ],
            [
                'kode' => 'Dhl',
                'nama' => 'Dagang Hasil Perikanan'
            ],
            [
                'kode' => 'DM',
                'nama' => 'Dagang Makanan'
            ],
            [
                'kode' => 'DbM',
                'nama' => 'Dagang Bukan Makanan'
            ],
            [
                'kode' => 'WR',
                'nama' => 'Warung'
            ],
            [
                'kode' => 'JT',
                'nama' => 'Jasa Transportasi'
            ],
            [
                'kode' => 'JP',
                'nama' => 'Jasa Perbengkelan'
            ],
            [
                'kode' => 'IRTK',
                'nama' => 'Industri Rumah Tangga dan Kerajinan'
            ],
            [
                'kode' => 'LL',
                'nama' => 'Lain-Lain'
            ],
        ]);
    }
}
