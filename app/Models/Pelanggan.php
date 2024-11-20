<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggan';
    protected $fillable = ['nama_member', 'kontak_member', 'alamat_member'];

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_member');
    }
}
