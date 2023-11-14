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
        Schema::create('pendaftaran_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_daftar',15)->unique();
            $table->foreignId('kantor_id');
            $table->foreignId('penginput_id');
            $table->enum('metode_bayar',['Cash','Transfer'])->nullable();
            $table->integer('nominal_bayar')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->enum('status',['Proses','Ditolak','Diajukan Ulang','Diterima'])->default('Proses');
            $table->timestamp('tanggal_daftar')->nullable();
            $table->timestamp('tanggal_diterima')->nullable();
            $table->boolean('is_submit')->default(false);
            $table->boolean('tahap_1')->default(false);
            $table->boolean('tahap_2')->default(false);
            $table->boolean('tahap_3')->default(false);
            $table->boolean('approve_admin')->default(false);
            $table->boolean('approve_branch_manager')->default(false);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_anggota');
    }
};
