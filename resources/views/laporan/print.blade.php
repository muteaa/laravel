<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Transaksi #{{ $transaksi->kode_transaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .invoice-details {
            margin: 20px 0;
        }
        .invoice-items {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-items th, .invoice-items td {
            border: 1px solid #000;
            padding: 8px;
        }
        .invoice-footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Nota Transaksi</h1>
            <p>Nomor Transaksi: {{ $transaksi->kode_transaksi }}</p>
        </div>

        <div class="invoice-details">
            <p><strong>Nama Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->format('d M Y') }}</p>
        </div>

        <table class="invoice-items">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksi as $detail)
                    <tr>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->jumlah_produk }}</td>
                        <td>Rp{{ number_format($detail->produk->harga_produk, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($detail->jumlah_produk * $detail->produk->harga_produk, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-footer">
            <p><strong>Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
            <p><strong>Total Pembayaran:</strong> Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Kembalian:</strong> Rp{{ number_format($transaksi->total_pembayaran - $totalHarga, 0, ',', '.') }}</p>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>
</body>

</html>
