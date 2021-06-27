<?php

namespace App\Repositories;

use App\OrderDetail;

class OrderDetailRepository
{
    public function create(array $data)
    {
        $orderDetail           = new OrderDetail;
        $orderDetail->order_id = $data['order_id'];
        $orderDetail->name     = $data['name'];
        $orderDetail->path     = $data['path'];
        $orderDetail->jumlah   = $data['jumlah'];
        $orderDetail->harga    = $data['harga'];

        $orderDetail->save();

        return $orderDetail;
    }

    public function getByOrderId(int $id)
    {
        return OrderDetail::where('order_id', $id)->get();
    }
}