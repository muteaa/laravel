<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Karyawan -->
                        <div class="mb-4">
                            <label for="nama_karyawan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Karyawan:
                            </label>
                            <input type="text" name="nama_karyawan" id="nama_karyawan"
                                value="{{ $karyawan->nama_karyawan }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <!-- Kontak Karyawan -->
                        <div class="mb-4">
                            <label for="kontak_karyawan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kontak Karyawan:
                            </label>
                            <input type="text" name="kontak_karyawan" id="kontak_karyawan"
                                value="{{ $karyawan->kontak_karyawan }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email:
                            </label>
                            <input type="email" name="email" id="email" value="{{ $karyawan->email }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>