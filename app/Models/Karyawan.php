<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    
    protected $table = 'karyawan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_karyawan',
        'kontak_karyawan',
        'email',
        'password',
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_karyawan');
    }
}
