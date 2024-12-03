<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('transaksi.update', ['id' => $transaksi->kode_transaksi ]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Pelanggan --}}
                    <div class="mb-4">
                        <label for="id_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                            Pelanggan</label>
                        <select id="id_member" name="id_member"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ $transaksi->id_member == $pelanggan->id ? 'selected' : '' }}>
                                    {{ $pelanggan->nama_member }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pilih Produk --}}
                    <div class="mb-4">
                        <label for="id_produk"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Produk</label>
                        <select id="id_produk" name="id_produk"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id_produk }}" {{ $transaksi->id_produk == $produk->id_produk ? 'selected' : '' }}>
                                    {{ $produk->nama_produk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Transaksi --}}
                    <div class="mb-4">
                        <label for="tgl_transaksi"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Transaksi</label>
                        <input type="date" id="tgl_transaksi" name="tgl_transaksi"
                            value="{{ $transaksi->tgl_transaksi }}"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700">
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>