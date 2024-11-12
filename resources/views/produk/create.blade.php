<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('produk.store') }}" method="POST">
                @csrf
                <div>
                    <label>Nama Produk:</label>
                    <input type="text" name="nama_produk" required>
                </div>
                <div>
                    <label>Deskripsi:</label>
                    <textarea name="deskripsi"></textarea>
                </div>
                <div>
                    <label>Harga:</label>
                    <input type="number" name="harga" required>
                </div>
                <div>
                    <label>Stok:</label>
                    <input type="number" name="stok" required>
                </div>
                <button type="submit">Add Produk</button>
            </form>
        </div>
    </div>
</x-app-layout>
