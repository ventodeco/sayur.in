<?php

namespace App\Repositories;

use App\Resep;

class ResepRepository
{
    public function getAllResep()
    {
        return Resep::all();
    }

    public function getById($id)
    {
        return Resep::find($id);
    }

    public function create(array $data)
    {
        $resep            = new Resep;
        $resep->name      = $data['name'];
        $resep->deskripsi = $data['deskripsi'];
        $resep->porsi     = $data['porsi'];
        $resep->harga     = $data['harga'];
        $resep->image     = $data['image'] ?? 'images/mi-ayam.jpeg';
        $resep->bahan     = $data['bahan'];
        $resep->prosedur  = $data['prosedur'];
        $resep->stock     = $data['stock'];
        $resep->user_id   = 1;

        $resep->save();

        return $resep;
    }

    public function update(
        Resep $resep,
        array $attrs
    ) {
        foreach ($attrs as $attr => $val) {
            $resep->{$attr} = $val;
        }

        $resep->save();
        
        return $resep;
    }

    public function getResepByBulkId(array $id)
    {
        return Resep::whereIn('id', $id)->get();
    }

    public function updateStock(Resep $resep)
    {
        $resep->stock = $resep->stock - $resep->keranjang_map_jumlah;
        $resep->save();

        return $resep;
    }
}