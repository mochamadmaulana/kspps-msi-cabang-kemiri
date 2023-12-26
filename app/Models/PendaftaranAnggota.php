<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAnggota extends Model
{
    use HasFactory;
    protected $table = "pendaftaran_anggota";
    protected $guarded = [];

    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function majlis()
    {
        return $this->belongsTo(Majlis::class);
    }

    public function referensi()
    {
        return $this->belongsTo(User::class,'referensi_id','id');
    }

    public function penginput()
    {
        return $this->belongsTo(User::class,'penginput_id','id');
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }
}
