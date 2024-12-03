<?php

namespace App\Models;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';  // Table name (optional, as it defaults to plural)
    protected $primaryKey = 'kode_transaksi';  // Custom primary key
    public $incrementing = true;  // Auto-increment primary key
    protected $keyType = 'int';  // Type of the primary key

    protected $fillable = [
        'id_pemilik',
        'id_karyawan',
        'id_member',
        'tgl_transaksi',
        'total_harga',
    ];

    // Relasi ke model User (Pemilik)
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik');
    }

    // Relasi ke model Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    // Relasi ke model Pelanggan (Member)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_member');
    }

    // Relasi ke model DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'kode_transaksi');
    }
}
