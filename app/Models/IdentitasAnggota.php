<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentitasAnggota extends Model
{
    use HasFactory;
    protected $table = "identitas_anggota";
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function tempat_lahir()
    {
        return $this->belongsTo(Kota::class,"tempat_lahir_id");
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class,"kota_kab_id");
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
