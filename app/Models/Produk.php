<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk');
    }
}
