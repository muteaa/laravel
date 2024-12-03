<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Loyalty Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('loyalitas.update', $pelanggan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Member</label>
                            <input type="text" name="nama_member" id="nama_member" value="{{ $pelanggan->nama_member }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                        </div>
                        <div class="mb-4">
                            <label for="kontak_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kontak Member</label>
                            <input type="text" name="kontak_member" id="kontak_member" value="{{ $pelanggan->kontak_member }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                        </div>
                        <div class="mb-4">
                            <label for="alamat_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Member</label>
                            <input type="text" name="alamat_member" id="alamat_member" value="{{ $pelanggan->alamat_member }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-400 dark:focus:border-blue-400">
                        </div>
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('loyalitas.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                                Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
