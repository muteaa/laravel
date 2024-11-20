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
                    {{ __("Manage your Loyalitas Pelanggan Here..  ") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('loyalitas.create') }}" class="btn btn-primary mb-4">Add Member</a>
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Nama Member</th>
                                <th class="border px-4 py-2">Kontak</th>
                                <th class="border px-4 py-2">Alamat</th>
                                <th class="border px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $member)
                                <tr>
                                    <td class="border px-4 py-2">{{ $member->id }}</td>
                                    <td class="border px-4 py-2">{{ $member->nama_member }}</td>
                                    <td class="border px-4 py-2">{{ $member->kontak_member }}</td>
                                    <td class="border px-4 py-2">{{ $member->alamat_member }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('loyalitas.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('loyalitas.destroy', $member->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>