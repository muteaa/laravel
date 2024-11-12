<?php

namespace Database\Factories;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaksiFactory extends Factory
{
    protected $model = Transaksi::class;

    public function definition()
    {
        return [
            'id_pemilik' => $this->faker->boolean ? User::factory() : null,
            'id_karyawan' => $this->faker->boolean ? Karyawan::factory() : null,
            'id_member' => Pelanggan::factory(),
            'tgl_transaksi' => $this->faker->date(),
            'total_harga' => $this->faker->randomFloat(2, 50, 1000),
        ];
    }
}
