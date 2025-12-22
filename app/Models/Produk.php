<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'kategori_id',
        'nama_produk',
        'slug',
        'harga_produk',
        'stok_produk',
        'deskripsi_produk',
        'status_produk'
    ];

    protected $table = 'tabel_produk';

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'produk_id');
    }
}
