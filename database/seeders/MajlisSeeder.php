<?php

namespace Database\Seeders;

use App\Models\Majlis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajlisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Majlis::insert([
            [
                'kode' => '001',
                'nama' => '001 PAGEDANGAN ILIR 03',
                'kantor_id' => '7',
                'kecamatan_id' => '4908',
                'kelurahan_id' => '49647',
                'alamat' => 'Kp. Pagedangan Ilir',
                'rt_rw' => '003/001',
                'petugas_id' => '4',
                'ketua_id' => null,
                'tanggal_berdiri' => '2022-10-18',
            ],
            [
                'kode' => '002',
                'nama' => '002 DAON TEKO 23',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kelurahan_id' => '49361',
                'alamat' => 'Kp. Kemiri',
                'rt_rw' => '023/005',
                'petugas_id' => '5',
                'ketua_id' => null,
                'tanggal_berdiri' => '2023-10-26',
            ],
            [
                'kode' => '003',
                'nama' => '003 KEMIRI 11',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kelurahan_id' => '49361',
                'alamat' => 'Kp. Kemiri',
                'rt_rw' => '011/003',
                'petugas_id' => '6',
                'ketua_id' => NULL,
                'tanggal_berdiri' => '2022-12-01',
            ],
            [
                'kode' => '004',
                'nama' => '004 KEMIRI 08',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kelurahan_id' => '49361',
                'alamat' => 'Kp. Kemiri',
                'rt_rw' => '008/002',
                'petugas_id' => '3',
                'ketua_id' => NULL,
                'tanggal_berdiri' => '2023-09-07',
            ],
            [
                'kode' => '005',
                'nama' => '005 PATRA MANGGALA 05',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kelurahan_id' => '49784',
                'alamat' => 'Kp. Patra Manggala',
                'rt_rw' => '004/002',
                'petugas_id' => '1',
                'ketua_id' => NULL,
                'tahun_berdiri' => '2023-01-31',
            ],
            [
                'kode' => '006',
                'nama' => '006 KARANG ANYAR 01',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kalurahan_id' => '49298',
                'alamat' => 'Kp. Karang Anyar',
                'rt_rw' => '001/001',
                'petugas_id' => '5',
                'ketua_id' => NULL,
                'tanggal_berdiri' => '2022-12-22',
            ],
            [
                'kode' => '007',
                'nama' => '007 PAGEDANGAN ILIR 06',
                'kantor_id' => '7',
                'kecamatan_id' => '3908',
                'kelurahan_id' => '49647',
                'alamat' => 'Kp. Pagedangan Ilir',
                'rt_rw' => '005/001',
                'petugas_id' => '6',
                'ketua_id' => NULL,
                'tanggal_berdiri' => '2022-02-21',
            ],
            [
                'kode' => '008',
                'nama' => '008 KEMIRI 10',
                'kantor_id' => '7',
                'kecamatan_id' => '4030',
                'kelurahan_id' => '49361',
                'alamat' => 'Kp. Kemiri',
                'rt_rw' => '005/001',
                'petugas_id' => '6',
                'ketua_id' => NULL,
                'tanggal_berdiri' => '2022-02-22',
            ]
        ]);
    }
}
