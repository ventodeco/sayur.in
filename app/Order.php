<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    const STATUS_UNPAID       = 'unpaid';
    const STATUS_PAID         = 'paid';
    const STATUS_PROCESSING   = 'processing';
    const STATUS_FINISH       = 'finish';

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'order_id', 'id');
    }

    public function getStatusPembayaranAttribute()
    {
        switch ($this->status) {
            case self::STATUS_UNPAID:
                return 'Belum Dibayar';
            case self::STATUS_PAID: 
                return 'Sudah Dibayar';
        }
    }

    public function getStatusOrderAttribute()
    {
        switch ($this->order_status) {
            case self::STATUS_PROCESSING:
                return 'Masih diproses';
            case self::STATUS_FINISH: 
                return 'Sudah Dikirim';
        }
    }
}
