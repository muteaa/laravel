<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier'])->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        return view('purchases.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal_pembelian' => 'required|date',
            'total_harga' => 'required|numeric',
            'status_pembayaran' => 'required|in:lunas,belum_lunas'
        ]);

        $validated['user_id'] = auth()->id();
        $validated['nomor_transaksi'] = 'PO-' . date('YmdHis');

        Purchase::create($validated);
        return redirect()->route('purchases.index')->with('success', 'Pembelian berhasil ditambahkan');
    }
} 