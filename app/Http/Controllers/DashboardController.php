<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'totalProducts' => Product::count() ?? 0,
            'totalSuppliers' => Supplier::count() ?? 0,
            'totalPurchases' => Purchase::count() ?? 0,
            'lowStockProducts' => Product::where('stok', '<=', 'stok_minimum')->get() ?? collect([])
        ];

        return view('dashboard', $data);
    }

    public function karyawan() {
        return view('karyawan');
    }

    public function produk() {
        return view('produk');
    }

    public function stokBarang() {
        return view('stok');
    }

    public function transaksiPenjualan() {
        return view('transaksi');
    }

    public function laporanTransaksiPenjualan() {
        return view('laporan');
    }

    public function loyalitasPelanggan() {
        return view('loyalitas');
    }
}
