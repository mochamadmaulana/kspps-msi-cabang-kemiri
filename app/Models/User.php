<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'no_induk',
        'username',
        'kantor_id',
        'password',
        'nama_lengkap',
        'email',
        'no_telepone',
        'tempat_lahir_id',
        'tanggal_lahir',
        'is_aktif',
        'role',
    ];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('no_induk','like','%'.$search.'%')
                ->orWhere('username','like','%'.$search.'%')
                ->orWhere('nama_lengkap','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                ->orWhere('role','like','%'.$search.'%')
                ->orWhere('no_telepone','like','%'.$search.'%')
                ->orWhereHas('tempat_lahir',fn($query) =>
                    $query->where('nama_kota','like','%'.$search.'%')
                )
        );
    }

    public function scopeAktif(Builder $query) : void
    {
        $query->where('is_aktif',true);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    public function tempat_lahir()
    {
        return $this->belongsTo(Kota::class,'tempat_lahir_id','id');
    }

    public function pendaftaran_anggota()
    {
        return $this->hasOne(PendaftaranAnggota::class);
    }

    public function majlis()
    {
        return $this->hasOne(Majlis::class);
    }
}
