<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomoditiUsaha extends Model
{
    use HasFactory;
    protected $table = "komoditi_usaha";
    protected $guarded = [];

    public function scopeSearch(Builder $query, string $search = null) : void
    {
        $query->where('nama','like','%'.$search.'%')
            ->orWhereHas('jenis_usaha',fn($query) =>
                $query->where('kode','like','%'.$search.'%')
                    ->orWhere('nama','like','%'.$search.'%')
            );
    }

    public function jenis_usaha()
    {
        return $this->belongsTo(JenisUsaha::class);
    }
}
