<?php
namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    public function definition()
    {
        return [
            'id' => rand(1000, 9999),  // Generate a random alphanumeric ID
            'nama_member' => $this->faker->name(),
            'kontak_member' => $this->faker->phoneNumber(),
            'alamat_member' => $this->faker->address(),
        ];
    }
}
