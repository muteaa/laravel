<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    protected $model = Produk::class;

    public function definition()
    {
        return [
            'nama_produk' => $this->faker->word(),
            'harga_produk' => $this->faker->randomFloat( 10000, 50000), // Harga antara 10 sampai 500
            'stok_produk' => $this->faker->numberBetween(10, 100),   // Stok antara 10 sampai 100
        ];
    }
}
