@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Laporan Transaksi</h1>

    @if ($transaksis->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Harga</th>
                        <th>Kode Referal</th>
                        <th>Detail Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->member->nama_member ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $item->kode_referal ?? '-' }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $item->kode_transaksi }}">
                                    Lihat Detail
                                </button>
                                <div class="collapse mt-2" id="detail-{{ $item->kode_transaksi }}">
                                    <ul class="list-group">
                                        @foreach ($item->details as $detail)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $detail->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                                <span class="badge bg-info">{{ $detail->jumlah_produk }} x Rp {{ number_format($detail->produk->harga_produk, 0, ',', '.') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">
            <strong>Belum ada transaksi yang tercatat.</strong>
        </div>
    @endif
</div>
@endsection
