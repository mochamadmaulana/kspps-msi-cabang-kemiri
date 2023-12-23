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
        Schema::create('usaha_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id');
            $table->foreignId('jenis_usaha_id');
            $table->foreignId('komoditi_usaha_id');
            $table->string('deskripsi_usaha',100);
            $table->string('foto_usaha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usaha_anggota');
    }
};
