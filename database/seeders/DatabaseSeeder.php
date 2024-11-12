<?php

namespace Database\Seeders;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Karyawan;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(count: 10)->create();

        User::factory()->create([
            'name' => 'Mario',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        Karyawan::factory(5)->create([
            'nama_karyawan' => 'Mutea',
            'kontak_karyawan' => '081241234123',
            'email' => 'mutea@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        Produk::factory(5)->create();
        Pelanggan::factory(5)->create(); 
        Transaksi::factory(10)->create(); 
        DetailTransaksi::factory(20)->create();

    }
}
