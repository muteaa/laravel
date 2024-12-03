<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-200">Daftar Transaksi</h3>
                    <a href="{{ route('transaksi.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                        Tambah Transaksi
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-700 dark:border-gray-600 text-sm">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                            <tr>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-center">No</th>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-center">Nama
                                    Pegawai</th>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-left">Nama
                                    Pelanggan</th>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-left">Tanggal
                                    Transaksi</th>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-right">Total Harga
                                </th>
                                <th class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                            @foreach ($transaksis as $index => $transaksi)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 text-white">
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-center">
                                        {{ $index + 1 }}
                                    </td>
                                    
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2">
                                        {{ $transaksi->karyawan ? $transaksi->karyawan->nama_karyawan : 'Pemilik' }}
                                    </td>
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2">
                                        {{ $transaksi->pelanggan->nama_member}}
                                    </td>
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2">
                                        {{ $transaksi->tgl_transaksi }}
                                    </td>
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-right">
                                        {{ number_format($transaksi->total_harga, 2) }}
                                    </td>
                                    <td class="border border-gray-700 dark:border-gray-600 px-4 py-2 text-center">
                                        <a href="{{ route('transaksi.edit', $transaksi->kode_transaksi) }}"
                                            class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('transaksi.destroy', $transaksi->kode_transaksi) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline"
                                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>