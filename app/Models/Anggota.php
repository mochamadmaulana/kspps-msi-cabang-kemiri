<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = "anggota";
    protected $guarded = [];

    public function tempat_lahir()
    {
        return $this->belongsTo(Kota::class,'tempat_lahir_id');
    }

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function jenis_usaha()
    {
        return $this->belongsTo(JenisUsaha::class);
    }

    public function majlis()
    {
        return $this->belongsTo(Majlis::class);
    }

    public function ketua_majlis()
    {
        return $this->hasMany(Majlis::class);
    }

    public function pendaftaran_anggota()
    {
        return $this->belongsTo(PendaftaranAnggota::class);
    }
    public function usaha_anggota()
    {
        return $this->hasOne(UsahaAnggota::class);
    }
}
