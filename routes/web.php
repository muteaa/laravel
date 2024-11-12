<?php

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
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan'); // List all karyawan
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create'); // Show form to create karyawan
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store'); // Store new karyawan
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit'); // Show form to edit karyawan
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update'); // Update karyawan
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy'); // Delete karyawan
//}


Route::get('/pelanggan', [PelangganController::class, 'index']);
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/create', [KaryawanController::class, 'create'])->name('produk.create'); // Show form to create karyawan
Route::post('/produk', [KaryawanController::class, 'store'])->name('produk.store'); // Store new karyawan
Route::get('/produk/{id}/edit', [KaryawanController::class, 'edit'])->name('produk.edit'); // Show form to edit karyawan
Route::put('/produk/{id}', [KaryawanController::class, 'update'])->name('produk.update'); // Update karyawan
Route::delete('/produk/{id}', [KaryawanController::class, 'destroy'])->name('produk.destroy'); // Delete karyawan

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/detail-transaksi', [DetailTransaksiController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/stok', function () {
    return view('stok');
})->middleware(['auth', 'verified'])->name('stok');

Route::get('/loyalitas', function () {
    return view('karyawan');
})->middleware(['auth', 'verified'])->name('loyalitas');

Route::get('/laporan', function () {
    return view('laporan');
})->middleware(['auth', 'verified'])->name('laporan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
