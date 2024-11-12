<?php

namespace Database\Factories;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTransaksiFactory extends Factory
{
    protected $model = DetailTransaksi::class;

    public function definition()
    {
        return [
            'kode_transaksi' => Transaksi::factory(),
            'id_produk' => Produk::factory(),
            'jumlah_produk' => $this->faker->numberBetween(1, 10),
        ];
    }
}
