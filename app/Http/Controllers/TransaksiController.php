<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('detailTransaksi.produk', 'pelanggan', 'karyawan')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $produks = Produk::all(); 
        $pelanggans = Pelanggan::all();
        $karyawans = Karyawan::all();
        return view('transaksi.create', compact('produks', 'pelanggans', 'karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_member' => 'required|exists:pelanggan,id',
            'produk' => 'required|array',
            'produk.*' => 'exists:produk,id_produk',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:1',
            'kode_referal' => 'nullable|exists:pelanggan,id',
        ]);

        $totalHarga = 0;

        foreach ($request->produk as $key => $produkId) {
            $produk = Produk::find($produkId);
            $jumlah = $request->jumlah[$key];
            $totalHarga += $produk->harga_produk * $jumlah;
        }

        if ($request->kode_referal) {
            $totalHarga *= 0.9; // Diskon 10%
        }

        $transaksi = Transaksi::create([
            'id_member' => $request->id_member,
            'tgl_transaksi' => now(),
            'total_harga' => $totalHarga,
        ]);

        foreach ($request->produk as $key => $produkId) {
            DetailTransaksi::create([
                'kode_transaksi' => $transaksi->kode_transaksi,
                'id_produk' => $produkId,
                'jumlah_produk' => $request->jumlah[$key],
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();

        return view('transaksi.edit', compact('transaksi', 'pelanggans', 'produks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_member' => 'required|exists:pelanggan,id',
            'produk' => 'required|array',
            'produk.*' => 'exists:produk,id_produk',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:1',
            'kode_referal' => 'nullable|exists:pelanggan,id',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $totalHarga = 0;

        // Update detail transaksi
        DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->delete();
        foreach ($request->produk as $key => $produkId) {
            $produk = Produk::find($produkId);
            $jumlah = $request->jumlah[$key];
            $totalHarga += $produk->harga_produk * $jumlah;

            DetailTransaksi::create([
                'kode_transaksi' => $transaksi->kode_transaksi,
                'id_produk' => $produkId,
                'jumlah_produk' => $jumlah,
            ]);
        }

        if ($request->kode_referal) {
            $totalHarga *= 0.9; // Diskon 10%
        }

        $transaksi->update([
            'id_member' => $request->id_member,
            'tgl_transaksi' => $request->tgl_transaksi,
            'total_harga' => $totalHarga,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
