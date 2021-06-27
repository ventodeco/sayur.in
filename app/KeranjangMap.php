<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeranjangMap extends Model
{
    use SoftDeletes;

    protected $table = 'keranjang_maps';

    public function resep()
    {
        return $this->belongsTo(Resep::class, 'resep_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
