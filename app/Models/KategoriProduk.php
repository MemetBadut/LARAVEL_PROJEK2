<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriProdukFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'parent_id',
        'slug'
    ];

    protected $table = 'kategori_produk';

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }

    public function parent()
    {
        return $this->belongsTo(KategoriProduk::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(KategoriProduk::class, 'parent_id');
    }
}
