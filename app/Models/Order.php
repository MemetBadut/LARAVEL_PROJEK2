<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillabel = [
        'customer_id',
        'total_harga',
        'order_status'
    ];

    protected $table = 'tabel_order';

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
