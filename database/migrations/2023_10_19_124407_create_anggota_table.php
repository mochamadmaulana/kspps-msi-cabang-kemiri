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
            $table->foreignId('kantor_id');
            $table->enum('jenis_keanggotaan',['Majlis','Umum']);
            $table->string('nama_lengkap');
            $table->foreignId('majlis_id');
            $table->enum('jenis_identitas',['KTP','SIM']);
            $table->string('no_identitas',25)->unique();
            $table->foreignId('tempat_lahir_id');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->enum('agama',['Islam','Hindu','Budha','Katolik','Protestan','Khonghucu']);
            $table->string('no_telepone',30);
            $table->enum('status_pernikahan',['Belum Menikah','Nikah','Cerai','Janda/Duda']);
            $table->enum('pendidikan_terakhir',['Tidak Bersekolah', 'SD', 'SMP', 'SMA', 'Diploma 3', 'Sarjana 1', 'Sarjana 2', 'Sarjana 3']);
            $table->enum('status_keanggotaan',['Tidak Aktif','Aktif','Dibekukan','Keluar']);
            $table->boolean('is_ketua_majlis')->default(false);
            $table->string('nama_ibu_kandung');
            $table->foreignId('jenis_usaha_id');
            $table->text('komoditi_usaha_id');

            $table->foreignId('provinsi_id')->nullable();
            $table->foreignId('kota_kab_id')->nullable();
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('kelurahan_id')->nullable();
            $table->string('kode_pos',5)->nullable();
            $table->string('rt_rw',7)->nullable();
            $table->text('alamat')->nullable();

            $table->string('ttd_anggota')->nullable();
            $table->string('foto_identitas')->nullable();
            $table->string('foto_selfie_identitas')->nullable();
            $table->string('foto_kartu_keluarga')->nullable();
            $table->string('foto_usaha')->nullable();

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
