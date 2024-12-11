<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <form action="{{ route('karyawan.store') }}" method="POST">
                        @csrf

                        <!-- Nama Karyawan -->
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-4">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    Nama Karyawan
                                </h3>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <input type="text" 
                                           name="nama_karyawan" 
                                           id="nama_karyawan" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak Karyawan -->
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-4">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    Kontak Karyawan
                                </h3>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <input type="text" 
                                           name="kontak_karyawan" 
                                           id="kontak_karyawan" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-4">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    Email
                                </h3>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-4">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200">
                                    Password
                                </h3>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700">
                                <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                           required>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
