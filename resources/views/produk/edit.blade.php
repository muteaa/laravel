<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label>Nama Produk:</label>
                    <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
                </div>
                <div>
                    <label>Harga:</label>
                    <input type="number" name="harga" value="{{ $produk->harga_produk}}" required>
                </div>
                <div>
                    <label>Stok:</label>
                    <input type="number" name="stok" value="{{ $produk->stok_produk}}" required>
                </div>
                <button type="submit">Update Produk</button>
            </form>
        </div>
    </div>
</x-app-layout>
