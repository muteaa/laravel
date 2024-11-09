<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'stok',
        'stok_minimum',
        'harga_beli',
        'harga_jual',
        'category_id',
        'deskripsi'
    ];
} 