<?php
namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik');
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function member()
    {
        return $this->belongsTo(Pelanggan::class, 'id_member');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'kode_transaksi');
    }
}
