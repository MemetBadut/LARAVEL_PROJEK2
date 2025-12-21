<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_id',
        'jumlah_barang',
        'harga_satuan',
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
