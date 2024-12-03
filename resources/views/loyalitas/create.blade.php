<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Loyalty Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-gray-100">
                    Enter Member Details
                </h3>

                <form action="{{ route('loyalitas.store') }}" method="POST">
                    @csrf

                    <!-- Nama Member -->
                    <div class="mb-4">
                        <label for="nama_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Member <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_member" name="nama_member" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Kontak Member -->
                    <div class="mb-4">
                        <label for="kontak_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kontak Member
                        </label>
                        <input type="text" id="kontak_member" name="kontak_member"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <!-- Alamat Member -->
                    <div class="mb-4">
                        <label for="alamat_member" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Alamat Member
                        </label>
                        <textarea id="alamat_member" name="alamat_member" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <a href="{{ route('loyalitas.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>