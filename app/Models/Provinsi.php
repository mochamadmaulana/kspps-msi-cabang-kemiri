<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = "provinsi";
    protected $guarded = [];

    function kota()
    {
        return $this->hasMany(Kota::class);
    }
    function kantor()
    {
        return $this->hasOne(Kantor::class);
    }
    function identitas_anggota()
    {
        return $this->hasOne(IdentitasAnggota::class);
    }
    function alamat_anggota()
    {
        return $this->hasOne(AlamatAnggota::class);
    }
}
