<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6" id="transaksiForm">
                    @csrf

                    <!-- Nama Pelanggan -->
                    <div>
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Pelanggan
                        </label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Nama Pegawai -->
                    <div>
                        <label for="karyawan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Pegawai
                        </label>
                        <select name="karyawan_id" id="karyawan_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="" selected disabled>Pilih Pegawai</option>
                            @foreach ($karyawans as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kode Referal -->
                    <div>
                        <label for="kode_referal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kode Referal
                        </label>
                        <div class="flex items-center space-x-2">
                            <input type="number" name="kode_referal" id="kode_referal"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <button type="button" id="cek-kode-referal"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md">
                                Cek
                            </button>
                        </div>
                        <span id="kode-referal-feedback" class="text-sm mt-1"></span>
                    </div>


                    <!-- Tabel Produk -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Produk</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Jumlah</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Subtotal</th>
                                    <th
                                        class="px-4 py-3 text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-container">
                                <tr class="produk-row">
                                    <td class="px-4 py-3">
                                        <select name="produk[]" required
                                            class="produk-dropdown mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="" selected disabled>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id_produk }}"
                                                    data-harga="{{ $produk->harga_produk }}">
                                                    {{ $produk->nama_produk }} -
                                                    Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" name="jumlah[]" value="1" min="1" required
                                            class="jumlah-produk mt-1 block w-24 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="subtotal text-gray-900 dark:text-gray-100 font-medium">Rp0</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button type="button"
                                            class="hapus-produk text-red-600 hover:text-red-800 hidden">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total Harga -->
                    <div class="flex justify-end mt-4">
                        <div class="text-lg font-medium text-gray-700 dark:text-gray-300">
                            <span>Total Harga: </span><span id="total-harga">Rp0</span>
                        </div>
                    </div>

                    <!-- Total Pembayaran -->
                    <div>
                        <label for="total_pembayaran"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Total Pembayaran
                        </label>
                        <input type="number" name="total_pembayaran" id="total_pembayaran" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Kembalian -->
                    <div class="flex justify-end mt-4">
                        <div class="text-lg font-medium text-gray-700 dark:text-gray-300">
                            <span>Kembalian: </span><span id="kembalian">Rp0</span>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6">
                        <button type="button" id="tambah-produk"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md">Tambah Produk</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produkContainer = document.getElementById('produk-container');
            const totalHargaElem = document.getElementById('total-harga');
            const totalPembayaranElem = document.getElementById('total_pembayaran');
            const kembalianElem = document.getElementById('kembalian');
            const transaksiForm = document.getElementById('transaksiForm');

            // Function to update the total price
            function updateTotalPrice() {
                let totalHarga = 0;

                document.querySelectorAll('.produk-row').forEach(row => {
                    const harga = parseFloat(row.querySelector('.produk-dropdown option:checked')?.dataset.harga || 0);
                    const jumlah = parseInt(row.querySelector('.jumlah-produk').value || 0);
                    const subtotal = harga * jumlah;

                    row.querySelector('.subtotal').textContent = 'Rp' + subtotal.toLocaleString('id-ID', { maximumFractionDigits: 0 });
                    totalHarga += subtotal;
                });

                totalHargaElem.textContent = 'Rp' + totalHarga.toLocaleString('id-ID', { maximumFractionDigits: 0 });
                return totalHarga;
            }

            // Function to update kembalian and validate payment
            function updateKembalian() {
                const totalHarga = updateTotalPrice();
                const totalPembayaran = parseFloat(totalPembayaranElem.value || 0);
                const kembalian = totalPembayaran - totalHarga;

                // Update kembalian display
                kembalianElem.textContent = 'Rp' + (kembalian > 0 ? kembalian.toLocaleString('id-ID', { maximumFractionDigits: 0 }) : 0);

                // Validate total pembayaran
                if (totalPembayaran < totalHarga) {
                    totalPembayaranElem.setCustomValidity('Total pembayaran tidak boleh kurang dari total harga');
                    kembalianElem.textContent = 'Rp0';
                } else {
                    totalPembayaranElem.setCustomValidity('');
                }
            }
            
            //Cek code referal 
            document.getElementById('cek-kode-referal').addEventListener('click', function () {
                const kodeReferal = document.getElementById('kode_referal').value;
                const feedbackElem = document.getElementById('kode-referal-feedback');

                if (!kodeReferal) {
                    feedbackElem.textContent = 'Kode referal belum di input!';
                    feedbackElem.className = 'text-red-500';
                    return;
                }

                // Gantikan URL ini dengan endpoint API validasi kode referal Anda
                fetch(`/api/validasi-referal?kode=${kodeReferal}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.valid) {
                            feedbackElem.textContent = 'Kode referal valid.';
                            feedbackElem.className = 'text-green-500';
                        } else {
                            feedbackElem.textContent = 'Kode referal tidak valid.';
                            feedbackElem.className = 'text-red-500';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        feedbackElem.textContent = 'Terjadi kesalahan saat memvalidasi kode referal.';
                        feedbackElem.className = 'text-red-500';
                    });
            });


            // Event listeners
            produkContainer.addEventListener('change', updateTotalPrice);
            totalPembayaranElem.addEventListener('input', updateKembalian);

            // Add product button
            document.getElementById('tambah-produk').addEventListener('click', function () {
                const rows = document.querySelectorAll('.produk-row');
                const newRow = rows[0].cloneNode(true);

                // Reset dropdown and quantity
                newRow.querySelector('.produk-dropdown').selectedIndex = 0;
                newRow.querySelector('.jumlah-produk').value = 1;
                newRow.querySelector('.subtotal').textContent = 'Rp0';

                // Show delete button on all rows
                rows.forEach(row => {
                    row.querySelector('.hapus-produk').classList.remove('hidden');
                });

                produkContainer.appendChild(newRow);
                updateTotalPrice();
            });

            // Delete product button
            produkContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('hapus-produk')) {
                    e.target.closest('.produk-row').remove();
                    updateTotalPrice();

                    // Hide delete button if only one row remains
                    const remainingRows = document.querySelectorAll('.produk-row');
                    if (remainingRows.length === 1) {
                        remainingRows[0].querySelector('.hapus-produk').classList.add('hidden');
                    }
                }
            });

            // Form submission validation
            transaksiForm.addEventListener('submit', function (e) {
                const totalHarga = updateTotalPrice();
                const totalPembayaran = parseFloat(totalPembayaranElem.value || 0);

                if (totalPembayaran < totalHarga) {
                    e.preventDefault();
                    alert('Total pembayaran tidak boleh kurang dari total harga');
                }
            });

            // Initial setup
            updateTotalPrice();
            document.querySelector('.hapus-produk').classList.add('hidden');
        });
    </script>
</x-app-layout>