<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Majlis extends Model
{
    use HasFactory;
    protected $table = "majlis";
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $search = null) : void
    {
        $query->where('kode','like','%'.$search.'%')
            ->orWhere('nama','like','%'.$search.'%')
            ->orWhere('kategori','like','%'.$search.'%')
            ->orWhere('alamat','like','%'.$search.'%')
            ->orWhereHas('kecamatan',fn($query) =>
                $query->where('nama_kecamatan','like','%'.$search.'%')
            )
            ->orWhereHas('kelurahan',fn($query) =>
                $query->where('nama_kelurahan','like','%'.$search.'%')
            )
            ->orWhereHas('petugas',fn($query) =>
                $query->where('nama_lengkap','like','%'.$search.'%')
            )
            ->orWhereHas('ketua',fn($query) =>
                $query->where('nama_lengkap','like','%'.$search.'%')
            );
    }

    // Relation table
    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function petugas()
    {
        return $this->belongsTo(User::class,'petugas_id','id');
    }
    public function ketua()
    {
        return $this->belongsTo(Anggota::class,'ketua_id','id');
    }
    public function pendaftaran_anggota()
    {
        return $this->hasMany(PendaftaranAnggota::class);
    }
}
