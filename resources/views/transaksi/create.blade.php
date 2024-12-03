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
                                <tr class="produk-row">
                                    <td class="px-4 py-3">
                                        <select name="produk[]" required
                                            class="produk-dropdown mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="" selected disabled>Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga_produk }}">
                                                    {{ $produk->nama_produk }} - Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}
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
                                        <button type="button" class="hapus-produk text-red-600 hover:text-red-800 hidden">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="px-4 py-3 text-right text-sm font-medium text-gray-700 dark:text-gray-300">Total:</td>
                                    <td colspan="2" class="px-4 py-3 text-lg font-bold text-gray-900 dark:text-gray-100">
                                        <span id="total-display">Rp0</span>
                                        <input type="hidden" name="total_harga" id="total_harga" value="0">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Tombol Tambah Produk -->
                    <div class="mt-4">
                        <button type="button" id="tambah-produk" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm">
                            Tambah Produk
                        </button>
                    </div>

                    <!-- Total Pembayaran -->
                    <div>
                        <label for="total_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Total Pembayaran
                        </label>
                        <input type="number" name="total_pembayaran" id="total_pembayaran" min="0" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm">
                        <small id="total-error" class="text-red-600 hidden">Total pembayaran tidak boleh kurang dari subtotal!</small>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md shadow-sm">
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

                function formatRupiah(number) {
                    return 'Rp' + new Intl.NumberFormat('id-ID').format(number);
                }

                function updateSubtotal(row) {
                    const dropdown = row.querySelector('.produk-dropdown');
                    const jumlahInput = row.querySelector('.jumlah-produk');
                    const subtotalSpan = row.querySelector('.subtotal');

                    const selectedOption = dropdown.options[dropdown.selectedIndex];
                    const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
                    const jumlah = parseInt(jumlahInput.value) || 1;
                    const subtotal = harga * jumlah;

                    subtotalSpan.textContent = formatRupiah(subtotal);
                    return subtotal;
                }

                function updateTotal() {
                    let total = 0;
                    document.querySelectorAll('.produk-row').forEach(row => {
                        total += updateSubtotal(row);
                    });
                    totalHargaInput.value = total;
                    totalDisplay.textContent = formatRupiah(total);

                    if (parseInt(totalPembayaranInput.value) < total) {
                        totalError.classList.remove('hidden');
                    } else {
                        totalError.classList.add('hidden');
                    }
                }

                tambahProdukButton.addEventListener('click', () => {
                    const newRow = produkContainer.querySelector('.produk-row').cloneNode(true);
                    newRow.querySelector('.hapus-produk').classList.remove('hidden');
                    produkContainer.appendChild(newRow);
                    updateTotal();
                });

                produkContainer.addEventListener('input', () => {
                    updateTotal();
                });

                produkContainer.addEventListener('click', e => {
                    if (e.target.classList.contains('hapus-produk')) {
                        e.target.closest('.produk-row').remove();
                        updateTotal();
                    }
                });

                totalPembayaranInput.addEventListener('input', () => {
                    updateTotal();
                });

                updateTotal();
            });
        </script>
    @endpush
</x-app-layout>
