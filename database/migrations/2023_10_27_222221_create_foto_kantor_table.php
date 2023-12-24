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
            $table->enum('jenis',['Thumbnail','Galeri']);
            $table->string('file_hash');
            $table->string('file_original');
            $table->string('file_size');
            $table->string('file_extention',10);
            $table->tinyInteger('posisi');
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
