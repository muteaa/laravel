<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Manage your Karyawan Here..") }}
                </div>
            </div>

            <!-- Align the Add Karyawan button to the right side -->
            <div class="flex justify-end mt-4">
                <div class="w-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-1">
                    <a href="{{ route('karyawan.create') }}"
                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                        Add Karyawan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <h1 class="text-xl font-bold mb-4 text-white">List Karyawan</h1>
            <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-white">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Nama Karyawan</th>
                        <th class="border px-4 py-2">Kontak Karyawan</th>
                        <th class="border px-4 py-2">Email</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $k)
                        <tr class="text-white">
                            <td class="border px-4 py-2">{{ $k->id }}</td>
                            <td class="border px-4 py-2">{{ $k->nama_karyawan }}</td>
                            <td class="border px-4 py-2">{{ $k->kontak_karyawan }}</td>
                            <td class="border px-4 py-2">{{ $k->email }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('karyawan.edit', $k->id) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('karyawan.destroy', $k->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>