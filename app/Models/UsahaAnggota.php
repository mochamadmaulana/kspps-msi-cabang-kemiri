<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsahaAnggota extends Model
{
    use HasFactory;
    protected $table = "usaha_anggota";
    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function jenis_usaha()
    {
        return $this->belongsTo(JenisUsaha::class);
    }
    public function komoditi_usaha()
    {
        return $this->belongsTo(KomoditiUsaha::class);
    }
}
