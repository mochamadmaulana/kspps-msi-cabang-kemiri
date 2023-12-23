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
        Schema::create('lampiran_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable();
            $table->string('file_hash');
            $table->string('file_original');
            $table->string('file_size');
            $table->string('file_extention',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiran_anggota');
    }
};
