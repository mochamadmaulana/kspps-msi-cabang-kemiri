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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('no_induk',7)->unique();
            $table->string('username',25)->unique();
            $table->foreignId('kantor_id');
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('no_telepone',13)->unique();
            $table->foreignId('tempat_lahir_id');
            $table->date('tanggal_lahir');
            $table->boolean('is_aktif')->default(true);
            $table->enum('role',['Admin','Kasi Pembiayaan','Kasi Keuangan','Staff Lapangan','Branch Manager']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
