<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatAnggota extends Model
{
    use HasFactory;
    protected $table = "alamat_anggota";
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function kota()
    {
        return $this->belongsTo(Kota::class,'kota_kab_id','id');
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
