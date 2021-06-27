<?php

namespace App\Repositories;

use App\Billing;
use App\Kota;

class BillingRepository
{
    public function create(array $data)
    {
        $billing                      = new Billing;
        $billing->name                = $data['name'];
        $billing->nomor_rekening      = $data['nomor_rekening'];
        $billing->user_id             = $data['user_id'];
        $billing->order_id            = $data['order_id'];
        $billing->nama_bank           = $data['nama_bank'];
        $billing->path_bukti_transfer = $data['bukti_transfer'];

        $billing->save();

        return $billing;
    }
}