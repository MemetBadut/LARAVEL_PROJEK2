<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_harga',
        'alamat_pengiriman',
        'provinsi',
        'kota',
        'kode_pos',
        'order_status'
    ];

    protected $table = 'tabel_order';

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeWithDetail($query)
    {
        return $query->select([
            'id',
            'user_id',
            'total_harga',
            'order_status',
            'alamat_pengiriman',
            'provinsi',
            'kota',
            'kode_pos'
        ])
            ->with([
                'customer:id,name',
                'orderItems:id,order_id,produk_id,jumlah_barang,harga_satuan',
                'orderItems.produk:id,nama_produk'
            ]);
    }
}
