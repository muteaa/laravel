<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Produk:</label>
                    <input type="text" id="nama_produk" name="nama_produk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
                </div>
                <div class="mb-4">
                    <label for="harga_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga:</label>
                    <input type="number" id="harga_produk" name="harga_produk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
                </div>
                <div class="mb-4">
                    <label for="stok_produk" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok:</label>
                    <input type="number" id="stok_produk" name="stok_produk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah Produk</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
