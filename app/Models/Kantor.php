<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;
    protected $table = "kantor";
    protected $guarded = [];

    // Relations
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function majlis()
    {
        return $this->hasMany(Majlis::class);
    }

    public function pendaftaran_anggota()
    {
        return $this->hasMany(PendaftaranAnggota::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kota_kab()
    {
        return $this->belongsTo(Kota::class);
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
