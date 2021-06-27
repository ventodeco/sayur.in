<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Resep extends Model
{
    use SoftDeletes;

    protected $table = 'reseps';

    public function keranjang_map()
    {
        return $this->hasMany(KeranjangMap::class, 'resep_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getResepValueAttribute()
    {
        $id = Auth::id();
        $map = $this->keranjang_map()
                    ->where('user_id', $id)
                    ->where('resep_id', $this->id)
                    ->where('flag', false)
                    ->first();
        
        return $map->jumlah;
    }

    public function getKeranjangMapIdAttribute()
    {
        $id = Auth::id();
        $map = $this->keranjang_map()
                    ->where('resep_id', $this->id)
                    ->where('user_id', $id)
                    ->where('flag', false)->first();

        return $map->id;
    }

    public function getKeranjangMapJumlahAttribute()
    {
        $id = Auth::id();
        $map = $this->keranjang_map()
                    ->where('resep_id', $this->id)
                    ->where('user_id', $id)
                    ->where('flag', false)->first();

        return $map->jumlah ?? null;
    }
}
