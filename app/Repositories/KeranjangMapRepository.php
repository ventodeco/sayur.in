<?php

namespace App\Repositories;

use App\KeranjangMap;

class KeranjangMapRepository
{
    public function getById($id)
    {
        return KeranjangMap::find($id);
    }

    public function getByUserId(int $id)
    {
        return KeranjangMap::where('user_id', $id)
                ->where('flag', false)    
                ->get();
    }

    public function getByResepAndUserId($userId, $resepId)
    {
        return KeranjangMap::where('user_id', $userId)
                            ->where('resep_id', $resepId)
                            ->where('flag', false)
                            ->first();
    }

    public function iterateJumlah(KeranjangMap $map)
    {
        $map->jumlah += 1;
        $map->save();

        return $map;
    }

    public function save(array $data)
    {
        $keranjangMap = new KeranjangMap();
        $keranjangMap->user_id  = $data['userId'];
        $keranjangMap->resep_id = $data['resepId'];
        $keranjangMap->flag     = false;
        $keranjangMap->jumlah   = 1;
        $keranjangMap->save();

        return $keranjangMap;
    }

    public function deleteByResepId(int $id, int $userId)
    {
        return KeranjangMap::where('resep_id', $id)
                ->where('user_id', $userId)
                ->where('flag', false)
                ->delete();
    }

    public function changeValue(int $value, KeranjangMap $map)
    {
        $map->jumlah = $value;
        $map->save();
        return $map;
    }

    public function flagMap(KeranjangMap $map)
    {
        $map->flag = true;
        $map->save();

        return $map;
    }
}