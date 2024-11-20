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
                                <!-- Template row yang akan diclone -->
                                <tr class="produk-row" data-row="0">
                                    <td class="px-4 py-3">
                                        <select name="produk[]" required
                                            class="produk-dropdown mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="" selected disabled>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id_produk }} "
                                                    data-harga="{{ $produk->harga_produk}}">
                                                    {{ $produk->nama_produk }} - Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" name="jumlah[]" required
                                            class="jumlah-produk mt-1 block w-24 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            value="1" min="1">
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="subtotal text-gray-900 dark:text-gray-100 font-medium">Rp0</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button type="button"
                                            class="hapus-produk hidden text-sm px-3 py-1 text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"
                                        class="px-4 py-3 text-right text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Total:
                                    </td>
                                    <td colspan="2"
                                        class="px-4 py-3 text-left text-lg font-bold text-gray-900 dark:text-gray-100">
                                        <span id="total-display">Rp0</span>
                                        <input type="hidden" name="total_harga" id="total_harga" value="0">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Tombol Tambah Produk -->
                    <div class="mt-4">
                        <button type="button" id="tambah-produk"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md shadow-sm">
                            Tambah Produk
                        </button>
                    </div>

                    <!-- Kode Referal -->
                    <div>
                        <label for="kode_referal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kode Referal (Opsional)
                        </label>
                        <input type="text" name="kode_referal" id="kode_referal"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Kolom Total Pembayaran -->
                    <div class="mt-4">
                        <label for="total_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Total Pembayaran
                        </label>
                        <input type="number" name="total_pembayaran" id="total_pembayaran" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="0" min="0">
                        <small id="total-error" class="text-red-600 hidden">Total pembayaran tidak boleh kurang dari subtotal!</small>
                    </div>

                    <!-- Tombol Submit dan Batal -->
                    <div class="flex justify-between space-x-2 mt-6">
                        <button type="button" onclick="window.location.href='{{ route('transaksi') }}'"
                            class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Batal
                        </button>

                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const produkContainer = document.getElementById('produk-container');
                const tambahProdukButton = document.getElementById('tambah-produk');
                const totalHargaInput = document.getElementById('total_harga');
                const totalDisplay = document.getElementById('total-display');
                const totalPembayaranInput = document.getElementById('total_pembayaran');
                const totalError = document.getElementById('total-error');
                let rowCounter = 0;

                function formatRupiah(angka) {
                    return 'Rp' + new Intl.NumberFormat('id-ID').format(angka);
                }

                function updateSubtotal(row) {
                    const dropdown = row.querySelector('.produk-dropdown');
                    const jumlahInput = row.querySelector('.jumlah-produk');
                    const subtotalSpan = row.querySelector('.subtotal');

                    const selectedOption = dropdown.options[dropdown.selectedIndex];
                    if (selectedOption && !selectedOption.disabled) {
                        const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
                        const jumlah = parseInt(jumlahInput.value) || 0;
                        const subtotal = harga_produk * jumlah;
                        subtotalSpan.textContent = formatRupiah(subtotal);
                        return subtotal;
                    }
                    subtotalSpan.textContent = 'Rp0';
                    return 0;
                }

                function updateTotalHarga() {
                    let total = 0;
                    const produkRows = produkContainer.querySelectorAll('.produk-row');
                    produkRows.forEach(row => {
                        total += updateSubtotal(row);
                    });
                    totalHargaInput.value = total;
                    totalDisplay.textContent = formatRupiah(total);
                    totalPembayaranInput.value = total;
                    totalError.classList.add('hidden');
                }

                // Event listener untuk produk dropdown
                produkContainer.addEventListener('change', (e) => {
                    if (e.target.classList.contains('produk-dropdown') || e.target.classList.contains('jumlah-produk')) {
                        updateTotalHarga();
                    }
                });

                // Tombol Tambah Produk
                tambahProdukButton.addEventListener('click', () => {
                    rowCounter++;
                    const newRow = produkContainer.querySelector('.produk-row').cloneNode(true);
                    newRow.dataset.row = rowCounter;
                    newRow.querySelector('.hapus-produk').classList.remove('hidden');
                    produkContainer.appendChild(newRow);
                    updateTotalHarga();
                });

                // Hapus Produk
                produkContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('hapus-produk')) {
                        e.target.closest('tr').remove();
                        updateTotalHarga();
                    }
                });

                // Validasi form
                const form = document.getElementById('transaksiForm');
                form.addEventListener('submit', (e) => {
                    if (parseInt(totalPembayaranInput.value) < parseInt(totalHargaInput.value)) {
                        totalError.classList.remove('hidden');
                        e.preventDefault();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
