<?php

namespace App\Repositories;

use App\Kota;

class KotaRepository
{
    public function getAll()
    {
        return Kota::all();
    }

    public function create(array $data)
    {
        $kota        = new Kota;
        $kota->harga = $data['harga'];
        $kota->name  = $data['name'];

        $kota->save();

        return $kota;
    }

    public function getById($id)
    {
        return Kota::find($id);
    }

    public function update(Kota $kota, array $attrs)
    {
        foreach ($attrs as $attr => $value) {
            $kota->{$attr} = $value;
        }

        $kota->save();

        return $kota;
    }

    public function delete(Kota $kota)
    {
        $kota->delete();

        return $kota;
    }
}