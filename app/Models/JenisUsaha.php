<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    use HasFactory;
    protected $table = "jenis_usaha";
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $search = null) : void
    {
        $query->where('kode','like','%'.$search.'%')
            ->orWhere('nama','like','%'.$search.'%');
            // ->orWhereHas('kecamatan',fn($query) =>
            //     $query->where('nama_kecamatan','like','%'.$search.'%')
            // );
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }
    public function komoditi_usaha()
    {
        return $this->hasMany(KomoditiUsaha::class);
    }
    public function usaha_anggota()
    {
        return $this->hasOne(UsahaAnggota::class);
    }
}
