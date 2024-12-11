<?php
namespace Database\Seeders;

use App\Models\Produk;
use App\Models\DetailTransaksi;
use App\Models\User;
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
        // Membuat user dan karyawan terlebih dahulu
        User::factory()->create([
            'name' => 'Mario',
            'email' => 'mario@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        Karyawan::factory()->create([
            'nama_karyawan' => 'Mutea',
            'kontak_karyawan' => '081241234123',
            'email' => 'mutea@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        // Membuat produk
        $produkData = [
            ['nama_produk' => 'Omurice', 'harga_produk' => 27000, 'stok_produk' => 100],
            ['nama_produk' => 'Gyudon', 'harga_produk' => 38000, 'stok_produk' => 100],
            ['nama_produk' => 'Oyakodon', 'harga_produk' => 22000, 'stok_produk' => 100],
            ['nama_produk' => 'Nasi Kare', 'harga_produk' => 25000, 'stok_produk' => 100],
            ['nama_produk' => 'Chicken Katsu', 'harga_produk' => 25000, 'stok_produk' => 100],
            ['nama_produk' => 'Katsudon', 'harga_produk' => 35000, 'stok_produk' => 100],
            ['nama_produk' => 'Doory Karaage', 'harga_produk' => 25000, 'stok_produk' => 100],
            ['nama_produk' => 'Black Tea', 'harga_produk' => 3000, 'stok_produk' => 100],
            ['nama_produk' => 'Ocha', 'harga_produk' => 5000, 'stok_produk' => 100],
            ['nama_produk' => 'Air Es', 'harga_produk' => 2000, 'stok_produk' => 100],
        ];
        foreach ($produkData as $data) {
            Produk::factory()->create($data);
        }

        // Membuat pelanggan
        $pelangganData = [
            ['nama_member' => 'Hailey', 'kontak_member' => '081234567890', 'alamat_member' => 'Babarsari'],
            ['nama_member' => 'Maryo', 'kontak_member' => '081234567890', 'alamat_member' => 'Seturan'],
        ];
        foreach ($pelangganData as $data) {
            Pelanggan::factory()->create($data);
        }

        // Uncomment and adapt this part if you need to create transactions and details
        /*
        $transaksis = Transaksi::factory(5)->create();

        foreach ($transaksis as $transaksi) {
            DetailTransaksi::factory(3)->create([
                'kode_transaksi' => $transaksi->kode_transaksi,
                'id_produk' => Produk::inRandomOrder()->first()->id,
                'jumlah_produk' => rand(1, 5),
            ]);
        }
        */
    }
}
