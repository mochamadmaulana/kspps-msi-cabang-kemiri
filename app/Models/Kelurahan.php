<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = "kelurahan";

    function kantor()
    {
        return $this->hasOne(Kantor::class);
    }
    function identitas_anggota()
    {
        return $this->hasOne(IdentitasAnggota::class);
    }
    function kelurahan_anggota()
    {
        return $this->hasOne(Kelurahan::class);
    }
}
