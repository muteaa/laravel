<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_transaksi',
        'supplier_id',
        'tanggal_pembelian',
        'total_harga',
        'status_pembayaran',
        'user_id'
    ];
} 