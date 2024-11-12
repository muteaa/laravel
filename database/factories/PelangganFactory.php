<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    public function definition()
    {
        return [
            'nama_member' => $this->faker->name(),
            'kontak_member' => $this->faker->phoneNumber(),
            'alamat_member' => $this->faker->address(),
        ];
    }
}
