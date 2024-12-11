<?php
namespace App\Models;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    protected $keyType = 'int'; // Tipe kunci adalah string
    protected $fillable = [
        'kode_transaksi',
        'id_produk',
        'jumlah_produk'
    ];


    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'kode_transaksi', 'kode_transaksi');
    }

    // In DetailTransaksi Model
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk'); // Make sure this is correct
    }

}
