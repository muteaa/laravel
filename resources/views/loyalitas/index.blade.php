<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Loyalitas Pelanggan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-lg font-semibold mb-2">Kelola Loyalitas Pelanggan</div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tambah, edit, atau hapus data member di tabel di bawah ini.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <div class="text-lg font-semibold">Daftar Member</div>
                        <a href="{{ route('loyalitas.create') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">
                            + Tambah Member
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white dark:bg-gray-800 shadow-md rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">ID</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nama Member</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Kontak</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Alamat</th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pelanggan as $member)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                            {{ $member->id }}
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                            {{ $member->nama_member }}
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                            {{ $member->kontak_member }}
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                            {{ $member->alamat_member }}
                                        </td>
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('loyalitas.edit', $member->id) }}"
                                                    class="text-yellow-500 hover:text-yellow-600 font-semibold py-1 px-3 rounded-md text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('loyalitas.destroy', $member->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus member ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-600 font-semibold py-1 px-3 rounded-md text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-600 dark:text-gray-400">
                                            Tidak ada data tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
