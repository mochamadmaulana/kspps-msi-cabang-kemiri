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
            $table->foreignId('penginput_id');
            $table->foreignId('kantor_id');
            $table->enum('status',['Unsubmit','Proses','Ditolak','Diajukan Ulang','Diterima'])->default('Unsubmit');
            $table->boolean('tahap_satu')->default(false);
            $table->boolean('tahap_dua')->default(false);
            $table->boolean('tahap_tiga')->default(false);
            $table->boolean('is_submit')->default(false);
            $table->boolean('approve_admin')->default(false);
            $table->boolean('approve_branch_manager')->default(false);
            $table->dateTime('tanggal_daftar')->useCurrent();
            $table->dateTime('tanggal_diterima')->nullable();
            $table->integer('nominal_bayar_daftar')->nullable();
            $table->enum('metode_bayar_daftar',['Cash','Transfer'])->nullable();
            $table->timestamps();
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
