<?php

namespace App\Repositories;

use App\Order;
use Illuminate\Support\Str;

class OrderRepository
{
    public function create(array $data)
    {
        $order = new Order;
        $order->user_id       = $data['user_id'];
        $order->amount        = $data['amount'];
        $order->status        = $data['status'];
        $order->order_status  = $data['order_status'];
        $order->alamat        = $data['alamat'];
        $order->kota          = $data['kota'];
        $order->notes         = $data['notes'] ?? null;
        $order->nama_penerima = $data['nama_penerima'];

        $order->save();

        return $order;
    }

    public function generateInvoiceNumber(Order $order)
    {
        $order->invoice_number = sprintf('INV/%s/%s', str_pad($order->id, 6, "0", STR_PAD_LEFT), Str::Random(4));
        $order->save();

        return $order;
    }

    public function getOrderByUserId($id)
    {
        return Order::where('user_id', $id)->get();
    }

    public function getById($id)
    {
        return Order::find($id);
    }

    public function changeToPaid(Order $order)
    {
        $order->status = Order::STATUS_PAID;
        $order->save();

        return $order;
    }

    public function update(
        Order $order,
        array $attrs
    ) {
        foreach ($attrs as $attr => $val) {
            $order->{$attr} = $val;
        }

        $order->save();
        
        return $order;
    }
}