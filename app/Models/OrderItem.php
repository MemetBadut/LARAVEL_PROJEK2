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

    protected $table = 'tabel_order_barang';

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function produk(){
        return $this->belongsTo(Produk::class);
    }
}
