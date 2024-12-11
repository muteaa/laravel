<?php

use App\Http\Controllers\LoyalitasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;

Route::get('/users', [UserController::class, 'index']);

//karyawan route
//{
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index'); // List all karyawan
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create'); // Show form to create karyawan
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store'); // Store new karyawan
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit'); // Show form to edit karyawan
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update'); // Update karyawan
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy'); // Delete karyawan
//}

Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create'); // Show form to create karyawan
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store'); // Store new karyawan
Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // Show form to edit karyawan
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update'); // Update karyawan
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy'); // Delete karyawan

// Loyalitas (Pelanggan) CRUD routes    
// Route::resource('loyalitas', LoyalitasController::class);
Route::prefix('admin')->group(function () {
    Route::get('/loyalitas', [LoyalitasController::class, 'index'])->name('loyalitas.index');
});
Route::get('/loyalitas/create', [LoyalitasController::class, 'create'])->name('loyalitas.create'); // Show form to create loyalitas
Route::post('/loyalitas', [LoyalitasController::class, 'store'])->name('loyalitas.store'); // Store new loyalitas
Route::get('/loyalitas/{id}/edit', [LoyalitasController::class, 'edit'])->name('loyalitas.edit'); // Show form to edit loyalitas
Route::put('/loyalitas/{id}', [LoyalitasController::class, 'update'])->name('loyalitas.update'); // Update loyalitas
Route::delete('/loyalitas/{id}', [LoyalitasController::class, 'destroy'])->name('loyalitas.destroy'); // Delete loyalitas

// Route::resource('transaksi', TransaksiController::class);
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create'); // Show form to create loyalitas
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store'); // Store new loyalitas
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit'); // Show form to edit loyalitas
Route::put('transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');

Route::delete('/laporan/destroy', [TransaksiController::class, 'destroy'])->name('transaksi.destroy'); // Delete loyalitas


Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan');
Route::get('/laporan/detail/{id}', [TransaksiController::class, 'detail'])->name('laporan.detail');
Route::get('/laporan/print/{id}', [TransaksiController::class, 'print'])->name('laporan.print');
Route::get('/laporan/print/{id}', [TransaksiController::class, 'show'])->name('laporan.print');
// Route::get('/detail-transaksi', [TransaksiController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/stok', function () {
    return view('stok');
})->middleware(['auth', 'verified'])->name('stok');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
