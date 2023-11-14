<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Karyawan Kantor Kemiri
        $branch_manager_kemiri = User::create([
            'no_induk' => 'MSI0057',
            'username' => 'diniyah57',
            'kantor_id' => '7',
            'nama_lengkap' => 'NURSITI DINIYAH',
            'email' => 'nursitidiniyah747@gmail.com',
            'no_telepone' => '085715416647',
            'tempat_lahir_id' => '246',
            'tanggal_lahir' => '1999-09-21',
            'is_aktif' => true,
            'role' => 'Branch Manager',
            'password' => Hash::make('password'),
        ]);
        $admin_kemiri = User::create([
            'no_induk' => 'MSI0075',
            'username' => 'hendrik75',
            'kantor_id' => '7',
            'nama_lengkap' => 'HENDRIK SURAHMAN',
            'email' => 'hendriklixon23@gmail.com',
            'no_telepone' => '085880631351',
            'tempat_lahir_id' => '246',
            'tanggal_lahir' => '1995-11-23',
            'is_aktif' => true,
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        $kasi_keuangan_kemiri = User::create([
            'no_induk' => 'MSI0060',
            'username' => 'wahyudin60',
            'kantor_id' => '7',
            'nama_lengkap' => 'WAHYUDIN',
            'email' => 'wahyudin@gmail.com',
            'no_telepone' => '08886183122',
            'tempat_lahir_id' => '246',
            'tanggal_lahir' => '2002-09-04',
            'is_aktif' => true,
            'role' => 'Kasi Keuangan',
            'password' => Hash::make('password'),
        ]);
        $kasi_pembiayaan_kemiri = User::create([
            'no_induk' => 'MSI0021',
            'username' => 'aldian21',
            'kantor_id' => '7',
            'nama_lengkap' => 'ALDIAN FIRMANDA',
            'email' => 'aldianfirmanda@gmail.com',
            'no_telepone' => '085850592930',
            'tempat_lahir_id' => '246',
            'tanggal_lahir' => '2001-09-05',
            'is_aktif' => true,
            'role' => 'Kasi Pembiayaan',
            'password' => Hash::make('password'),
        ]);
        $staff_lapangan_kemiri = User::insert([
            [
                'no_induk' => 'MSI0100',
                'username' => 'saepul100',
                'kantor_id' => '7',
                'nama_lengkap' => 'SAEPUL HIDAYAT',
                'email' => 'hidayatsaepul111@gmail.com',
                'no_telepone' => '089630309545',
                'tempat_lahir_id' => '246',
                'tanggal_lahir' => '2000-09-04',
                'is_aktif' => true,
                'role' => 'Staff Lapangan',
                'password' => Hash::make('password'),
            ],
            [
                'no_induk' => 'MSI0110',
                'username' => 'intan110',
                'kantor_id' => '7',
                'nama_lengkap' => 'INTAN SARI',
                'email' => 'intansr480@gmail.com',
                'no_telepone' => '085694866488',
                'tempat_lahir_id' => '246',
                'tanggal_lahir' => '2005-10-25',
                'is_aktif' => true,
                'role' => 'Staff Lapangan',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
