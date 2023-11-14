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
        Schema::create('foto_kantor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id');
            $table->string('nama_file');
            $table->string('ukuran_file');
            $table->tinyInteger('urutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_kantor');
    }
};