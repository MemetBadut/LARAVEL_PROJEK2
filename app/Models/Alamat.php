<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model {
    use HasFactory;
    protected $fillable = [
        'user_id',
        'recipient_name',
        'alamat_lengkap',
        'daerah',
        'kota',
        'provinsi',
        'kode_pos'
    ];

    protected $table = 'tabel_alamat';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

