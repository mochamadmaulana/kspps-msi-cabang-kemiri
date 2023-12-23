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
        Schema::create('alamat_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id');
            $table->enum('jenis',['Identitas','Usaha']);
            $table->string('alamat');
            $table->foreignId('provinsi_id');
            $table->foreignId('kota_kab_id');
            $table->foreignId('kecamatan_id');
            $table->foreignId('kelurahan_id');
            $table->string('rt_rw',7);
            $table->string('kode_pos',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat_anggota');
    }
};
