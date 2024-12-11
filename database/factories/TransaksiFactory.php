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
            'id_pemilik' => $this->faker->boolean ? User::factory() : null,  // Will create a User if boolean is true, else null
            'id_karyawan' => $this->faker->boolean ? Karyawan::factory() : null,  // Will create a Karyawan if boolean is true, else null
            'id_member' => $this->faker->boolean ? Pelanggan::factory() : null,  // Always create a Pelanggan
            'tgl_transaksi' => $this->faker->date(),
            'nama_pelanggan' => $this->faker->name(),
            'total_harga' => $this->faker->randomFloat(2, 10000, 50000),  // Random float between 50 and 1000 with 2 decimal places
        ];
    }
}
