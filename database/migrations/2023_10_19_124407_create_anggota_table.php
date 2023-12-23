<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_anggota_id');
            $table->foreignId('kantor_id');
            $table->foreignId('majlis_id');
            $table->enum('jenis_keanggotaan',['Majlis','Umum']);
            $table->enum('jenis_identitas',['KTP','SIM']);
            $table->string('nomor_identitas',17)->unique();
            $table->string('nama_lengkap');
            $table->string('email')->nullable();
            $table->string('nomor_telepone',15);
            $table->foreignId('tempat_lahir_id');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->enum('agama',['Islam','Hindu','Budha','Katolik','Protestan','Khonghucu']);
            $table->enum('status_pernikahan',['Belum Menikah','Nikah','Cerai','Janda/Duda']);
            $table->enum('pendidikan_terakhir',['Tidak Bersekolah', 'SD', 'SMP', 'SMA', 'Diploma 3', 'Sarjana 1', 'Sarjana 2', 'Sarjana 3']);
            $table->enum('status_keanggotaan',['Tidak Aktif','Aktif','Dibekukan','Keluar'])->default('Tidak Aktif');
            $table->string('nama_ibu_kandung');
            $table->boolean('is_ketua_majlis')->default(false);
            $table->string('nomor_kartu_keluarga');

            $table->string('file_identitas')->nullable();
            $table->string('file_selfie_identitas')->nullable();
            $table->string('file_kartu_keluarga')->nullable();
            $table->string('ttd_anggota')->nullable();
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
