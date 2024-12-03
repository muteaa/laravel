<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Manage your Produk Here..") }}
                </div>
            </div>

            <!-- Align the Add Karyawan button to the right side -->
            <div class="flex justify-end mt-4">
                <div class="w-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-1">
                    <a href="{{ route('produk.create') }}"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                        Add Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-xl font-bold mb-4 text-white">List Produk</h1>
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700 text-white">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 ">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama Produk</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                        <tr>
                            <td class="border px-4 py-2">{{ $p->id_produk}}</td>
                            <td class="border px-4 py-2">{{ $p->nama_produk }}</td>
                            <td class="border px-4 py-2">{{ $p->harga_produk}}</td>
                            <td class="border px-4 py-2">{{ $p->stok_produk}}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('produk.edit', $p->id_produk) }}" class="btn btn-secondary text-blue-500">Edit</a>
                                <form action="{{ route('produk.destroy', $p->id_produk) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>