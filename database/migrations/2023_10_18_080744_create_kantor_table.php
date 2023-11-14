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
        Schema::create('kantor', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',50);
            $table->string('kode',3);
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_telepone',15)->nullable();
            $table->foreignId('provinsi_id');
            $table->foreignId('kota_kab_id');
            $table->foreignId('kecamatan_id');
            $table->foreignId('kelurahan_id');
            $table->string('rt_rw',7)->nullable();
            $table->text('alamat')->nullable();
            $table->boolean('is_pusat')->default(false);
            $table->string('foto')->nullable()->default(null);
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kantor');
    }
};
