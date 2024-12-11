<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <form action="{{ route('transaksi.update', $transaksi->kode_transaksi) }}" method="POST" class="space-y-6" id="transaksiForm">
                    @csrf
                    @method('PUT')

                    <!-- Nama Pelanggan -->
                    <div>
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Pelanggan
                        </label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" value="{{ $transaksi->nama_pelanggan }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Nama Pegawai -->
                    <div>
                        <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Pegawai
                        </label>
                        <select name="karyawan_id" id="karyawan_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">
                                    {{ $karyawan->nama_karyawan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kode Referal -->
                    <div>
                        <label for="kode_referal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kode Referal
                        </label>
                        <input type="number" name="kode_referal" id="kode_referal" value="{{ $transaksi->kode_referal }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                  <!-- Tabel Produk -->
                  <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Produk</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Subtotal</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-container">
                                @foreach ($produkDetails as $index => $detail)
                                    <tr class="produk-row">
                                        <td class="px-4 py-3">
                                            <select name="produk[]" class="produk-dropdown mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                @foreach ($produks as $prod)
                                                    <option value="{{ $prod->id }}" data-harga="{{ $prod->harga_produk }}">
                                                        {{ $prod->nama_produk }} - Rp{{ number_format($prod->harga_produk, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="px-4 py-3">
                                            <input type="number" name="jumlah[]" value="{{ $detail['jumlah'] }}" min="1" required
                                                class="jumlah-produk mt-1 block w-24 rounded-md border-gray-300 dark:border-gray-700">
                                        </td>
                                        <td class="px-4 py-3 subtotal">
                                            Rp{{ number_format($detail['produk']->harga_produk * $detail['jumlah'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="mt-6 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
      window.onload = function () {
    // Mengambil ID karyawan dari transaksi
    var karyawanId = @json($transaksi->id_karyawan);
    var selectElement = document.getElementById('karyawan_id');
    var options = selectElement.options;

    // Mengatur default value untuk dropdown karyawan
    for (var i = 0; i < options.length; i++) {
        if (options[i].value == karyawanId) {
            options[i].selected = true;
            break;
        }
    }   
 
    // Mengambil semua id_produk dari produkDetails
    const transaksiProdukIds = @json($produkDetails->pluck('produk.id_produk'));
  
    // Mengatur default value untuk dropdown produk[]
    const produkDropdowns = document.querySelectorAll('.produk-dropdown');
    produkDropdowns.forEach((dropdown, index) => {
    const produkId = transaksiProdukIds[index]; // Produk ID dari transaksi berdasarkan indeks
    
    if (produkId) {
        const options = dropdown.options;
    
        for (let i = 0; i < options.length; i++) {
            
            if (options[i].value == produkId) {
               
                options[i].selected = true;
                break;
            }
        }
    } else {
        console.warn(`Produk ID untuk index ${index} tidak ditemukan.`);
    }
});

};

    </script>

</x-app-layout>
