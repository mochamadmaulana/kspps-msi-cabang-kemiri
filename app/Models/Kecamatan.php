<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = "kecamatan";

    function kantor()
    {
        return $this->hasOne(Kantor::class);
    }
    function majlis()
    {
        return $this->hasMany(Majlis::class);
    }
}
