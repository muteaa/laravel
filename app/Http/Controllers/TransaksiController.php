<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Karyawan;
use App\Models\Pelanggan;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Carbon\carbon;

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
        // dd($request->all());
        // $request->validate([
        //     'nama_pelanggan' => 'required|string|max:255',
        //     'produk' => 'required|array',
        //     'produk.*' => 'exists:produk,id_produk',
        //     'jumlah' => 'required|array',
        //     'jumlah.*' => 'numeric|min:1',
        //     'kode_referal' => 'nullable|exists:pelanggan,id',
        //     'karyawan_id' => 'required|exists:karyawan,id',
        // ]);

        // dd('Passed Validation', $request->all());  // Pastikan ini dipanggil setelah validasi


        $totalHarga = 0;
        foreach ($request->produk as $key => $produkId) {
            $produk = Produk::find($produkId);
            if (!$produk) {
                return redirect()->back()->withErrors(['produk' => 'Produk tidak ditemukan.']);
            }
            $jumlah = $request->jumlah[$key];
            $totalHarga += $produk->harga_produk * $jumlah;
        }

        $kode = Pelanggan::find($request->kode_referal);
        if ($kode == null) {
            $transaksi = Transaksi::create([

                'nama_pelanggan' => $request->nama_pelanggan,
                'tgl_transaksi' => now(),
                'total_harga' => $totalHarga,
                'total_pembayaran' => $totalHarga,
                'id_karyawan' => $request->karyawan_id,
            ]);
        } else {
            $totalHarga = $totalHarga - ($totalHarga * 0.1);
            $transaksi = Transaksi::create([
                'id_member' => $request->kode_referal,
                'nama_pelanggan' => $request->nama_pelanggan,
                'tgl_transaksi' => now(),
                'total_harga' => $totalHarga,
                'total_pembayaran' => $totalHarga,
                'id_karyawan' => $request->karyawan_id,
            ]);
        }


        // dd($transaksi->kode_transaksi);  // Untuk mendapatkan id transaksi yang baru dibuat

        foreach ($request->produk as $key => $produkId) {
            DetailTransaksi::create([
                'kode_transaksi' => $transaksi->kode_transaksi, // Gunakan ID jika kode_transaksi tidak ada
                'id_produk' => $produkId,
                'jumlah_produk' => $request->jumlah[$key],
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        // Ambil transaksi berdasarkan ID dengan eager load detailTransaksi dan produk
        $transaksi = Transaksi::with('detailTransaksi.produk') // Eager loading untuk produk
            ->findOrFail($id);

        // Cek relasi detailTransaksi dan produk
        // dd($transaksi->detailTransaksi);

        // Ambil data terkait lainnya
        $karyawans = Karyawan::all();
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();  // Ambil semua produk untuk dropdown
        // dd($transaksi->karyawan_id, $transaksi->id_karyawan, $produks, $karyawans);

        // Strukturkan data produk yang akan digunakan pada view
        $produkDetails = $transaksi->detailTransaksi->map(function ($item) {
            return [
                'produk' => $item->produk, // Ambil produk dari relasi
                'jumlah' => $item->jumlah_produk,
                'subtotal' => $item->jumlah_produk * $item->produk->harga_produk,
            ];
        });

        return view('transaksi.edit', compact('transaksi', 'produkDetails', 'karyawans', 'produks', 'pelanggans'));
    }







    public function update(Request $request, $id)
    {

        // dd($request->all());
        // Validasi data
        // $request->validate([
        //     'nama_pelanggan' => 'required|string|max:255',
        //     'produk' => 'required|array',
        //     'produk.*' => 'exists:produk,id_produk',
        //     'jumlah' => 'required|array',
        //     'jumlah.*' => 'numeric|min:1',
        //     // 'kode_referal' => 'nullable|exists:pelanggan,id',
        //     // 'karyawan_id' => 'required|exists:karyawan,id',
        // ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail(id: $id);

        // Hitung total harga
        $totalHarga = 0;
        // dd($request->produk);
        // foreach ($request->produk as $key => $produkId) {

        //     $produk = Produk::find($produkId);
        //     if (!$produk) {
        //         return redirect()->back()->withErrors(['produk' => 'Produk tidak ditemukan.']);
        //     }
        //     $jumlah = $request->jumlah[$key];
        //     $totalHarga += $produk->harga_produk * $jumlah;
        // }

        // Jika memiliki kode referal, tambahkan diskon
        if ($request->kode_referal) {
            $totalHarga *= 0.9; // Diskon 10%
        }

        // Update data transaksi
        $transaksi->update([
            'id_member' => $request->kode_referal,
            'nama_pelanggan' => $request->nama_pelanggan,
            'tgl_transaksi' => now(), // Bisa tetap sekarang, atau tetapkan sesuai tgl awal
            'total_harga' => $totalHarga,
            'total_pembayaran' => $totalHarga,
            'id_karyawan' => $request->karyawan_id,
        ]);

        // Update atau sinkronisasi data produk dalam transaksi
        // Hapus detail lama terlebih dahulu
        DetailTransaksi::where('kode_transaksi', $transaksi->kode_transaksi)->delete();

        // Tambahkan detail baru
        foreach ($request->produk as $key => $produkId) {
            DetailTransaksi::create([
                'kode_transaksi' => $transaksi->kode_transaksi,
                'id_produk' => $produkId,
                'jumlah_produk' => $request->jumlah[$key],
            ]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }



    public function destroy()
    {
        $sevenMonthsAgo = Carbon::now()->subMonths(7);
        $deleted = Transaksi::where('created_at', '<', $sevenMonthsAgo)->delete();

        return response()->json([
            'message' => "$deleted transaksi yang lebih dari 7 bulan berhasil dihapus."
        ]);
    }

    public function laporan()
    {
        $transaksis = Transaksi::with('detailTransaksi.produk')
            ->orderBy('tgl_transaksi', 'desc')
            ->get();
        return view('laporan.laporan', compact('transaksis'));
    }

    public function detail($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);

        if (!$transaksi) {
            return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json([
            'transaksi' => [
                'nama_pelanggan' => $transaksi->nama_pelanggan,
                'tgl_transaksi' => $transaksi->tgl_transaksi,
                'total_harga' => $transaksi->total_harga,
            ],
            'detail_transaksi' => $transaksi->detailTransaksi->map(function ($detail) {
                return [
                    'produk' => [
                        'nama_produk' => $detail->produk->nama_produk,
                        'harga_produk' => $detail->produk->harga_produk,
                    ],
                    'jumlah_produk' => $detail->jumlah_produk,
                ];
            }),
        ]);
    }

    public function print($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);
        return view('laporan.print', compact('transaksi'));
    }

    public function show($id)
    {
        // Ambil data transaksi dengan relasi detail dan produk
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);

        // Hitung total harga
        $totalHarga = $transaksi->detailTransaksi->sum(function ($detail) {
            return $detail->jumlah_produk * $detail->produk->harga_produk;
        });

        // Return view untuk laporan cetak
        return view('laporan.print', compact('transaksi', 'totalHarga'));
    }

}
