<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_produk',
        'kategori_daging',
        'nama_produk',
        'harga_produk',
        'jumlah_stok',
    ];
}
