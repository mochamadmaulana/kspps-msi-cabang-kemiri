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
        Schema::create('majlis', function (Blueprint $table) {
            $table->id();
            $table->string('kode',5);
            $table->string('nama');
            $table->enum('kategori',['MMU','MMG']);
            $table->foreignId('kantor_id');
            $table->foreignId('kecamatan_id')->nullable();
            $table->foreignId('kelurahan_id')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt_rw',7)->nullable();
            $table->foreignId('petugas_id');
            $table->foreignId('ketua_id')->nullable();
            $table->date('tanggal_berdiri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majlis');
    }
};
