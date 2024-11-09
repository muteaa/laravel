<!DOCTYPE html><<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Oyako Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="logo-section">
                <div class="logo">WARUNG OYAKO</div>
                <span class="role">Pemilik</span>
            </div>
            <ul class="menu">
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}">Home</a>
                </li>
                <li class="{{ request()->is('karyawan') ? 'active' : '' }}">
                    <a href="{{ url('/karyawan') }}">Karyawan</a>
                </li>
                <li class="{{ request()->is('produk') ? 'active' : '' }}">
                    <a href="{{ url('/produk') }}">Produk</a>
                </li>
                <li class="{{ request()->is('stok') ? 'active' : '' }}">
                    <a href="{{ url('/stok') }}">Stok Barang</a>
                </li>
                <li class="{{ request()->is('transaksi') ? 'active' : '' }}">
                    <a href="{{ url('/transaksi') }}">Transaksi Penjualan</a>
                </li>
                <li class="{{ request()->is('laporan') ? 'active' : '' }}">
                    <a href="{{ url('/laporan') }}">Laporan Transaksi Penjualan</a>
                </li>
                <li class="{{ request()->is('loyalitas') ? 'active' : '' }}">
                    <a href="{{ url('/loyalitas') }}">Loyalitas Pelanggan</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <div class="content-area">
                @yield('content')
            </div>
        </div>
    </div>
</body>
   </div>
        </div>
    </div>
</body>
</html>
