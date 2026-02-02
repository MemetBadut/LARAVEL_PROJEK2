<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'gambar',
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

public function orderItems(){
        return $this->hasMany(OrderItem::class, 'produk_id');
}

    public function scopeByVendor($query, $vendorId)
    {
        return $query->where('vendor_id', $vendorId);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function booted()
    {
        static::creating(function ($produk) {
            $produk->slug = Str::slug($produk->nama_produk) . '-' . uniqid();
        });
    }

    public function getStockStatusAttribute()
    {
        $stok = max(0, $this->stok_produk);

        return match (true) {
            $stok > 10 => 'tersedia',
            $stok <= 10 && $stok > 0  => 'hampir_habis',
            default => 'habis',
        };
    }

    public function getStockBadgeAttribute()
    {
        return match ($this->stock_status) {
            'tersedia' => [
                'bg' => 'bg-green-100',
                'text' => 'text-green-800',
                'dot' => 'bg-green-400',
                'label' => 'In Stock'
            ],
            'hampir_habis' => [
                'bg' => 'bg-yellow-100',
                'text' => 'text-yellow-800',
                'dot' => 'bg-yellow-400',
                'label' => 'Low Stock'
            ],
            'habis' => [
                'bg' => 'bg-red-100',
                'text' => 'text-red-800',
                'dot' => 'bg-red-400',
                'label' => 'Out of Stock'
            ],
            default => [
                'bg' => 'bg-gray-100',
                'text' => 'text-gray-800',
                'dot' => 'bg-gray-400',
                'label' => 'Unknown'
            ]
        };
    }

    public function scopeTersedia($query)
    {
        return $query->where('stok_produk', '>', 10);
    }
    public function scopeHampirHabis($query)
    {
        return $query->whereBetween('stok_produk', [1, 9]);
    }
    public function scopeHabis($query)
    {
        return $query->where('stok_produk', '<=', 0);
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('nama_produk', 'like', "%{$keyword}%");
    }

    public function scopeFilterStock($query, $range)
    {
        return match ($range) {
            'high' => $query->where('stok_produk', '>', 50),
            'medium' => $query->whereBetween('stok_produk', [11, 50]),
            'low' => $query->whereBetween('stok_produk', [1, 10]),
            'zero' => $query->where('sto k_produk', '<=', 0)
        };
    }

    public function scopeFilterPrice($query, $range)
    {
        return match ($range) {
            'price_low' => $query->orderBy('harga_produk', 'asc'),
            'price_high' => $query->orderBy('harga_produk', 'desc'),
            default => $query,
        };
    }

    public function scopeFilterName($query, $range)
    {
        return match ($range) {
            'name_asc' => $query->orderBy('nama_produk', 'asc'),
            'name_desc' => $query->orderBy('nama_produk', 'desc')
        };
    }
}
