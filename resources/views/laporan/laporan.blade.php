<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <table id="laporan-transaksi" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Pelanggan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Tanggal Transaksi</th>
                                <th
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody
                            class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700 text-white">
                            @foreach ($transaksis as $index => $transaksi)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaksi->nama_pelanggan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('laporan.print', $transaksi->kode_transaksi) }}"
                                                target="_blank"
                                                class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-600">
                                                Print
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Transaksi -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Detail Transaksi
                    </h3>
                    <div class="mt-4" id="modal-content">
                        <!-- Detail transaksi akan diisi oleh JavaScript -->
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onclick="closeDetailModal()" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showDetailModal(transaksiId) {
                fetch(`/laporan/detail/${transaksiId}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal memuat detail transaksi.');
                        return response.json();
                    })
                    .then(data => {
                        const modalContent = document.getElementById('modal-content');
                        let detailHtml = `
                    <p><strong>Nama Pelanggan:</strong> ${data.transaksi.nama_pelanggan}</p>
                    <p><strong>Tanggal Transaksi:</strong> ${new Date(data.transaksi.tgl_transaksi).toLocaleDateString()}</p>
                    <p><strong>Total Harga:</strong> Rp${new Intl.NumberFormat('id-ID').format(data.transaksi.total_harga)}</p>
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Produk</th>
                                <th class="border px-4 py-2">Jumlah</th>
                                <th class="border px-4 py-2">Harga</th>
                                <th class="border px-4 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                        data.detail_transaksi.forEach(detail => {
                            detailHtml += `
                        <tr>
                            <td class="border px-4 py-2">${detail.produk.nama_produk}</td>
                            <td class="border px-4 py-2 text-right">${detail.jumlah_produk}</td>
                            <td class="border px-4 py-2 text-right">Rp${new Intl.NumberFormat('id-ID').format(detail.produk.harga_produk)}</td>
                            <td class="border px-4 py-2 text-right">Rp${new Intl.NumberFormat('id-ID').format(detail.jumlah_produk * detail.produk.harga_produk)}</td>
                        </tr>
                    `;
                        });
                        detailHtml += '</tbody></table>';
                        modalContent.innerHTML = detailHtml;
                        document.getElementById('detailModal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Gagal memuat detail transaksi.');
                    });
            }

            function closeDetailModal() {
                document.getElementById('detailModal').classList.add('hidden');
            }
        </script>
    @endpush
</x-app-layout>