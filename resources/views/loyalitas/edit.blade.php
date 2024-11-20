<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Loyalty Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('loyalitas.update', $pelanggan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label>Nama Member</label>
                            <input type="text" name="nama_member" value="{{ $pelanggan->nama_member }}" required class="form-control">
                        </div>
                        <div>
                            <label>Kontak Member</label>
                            <input type="text" name="kontak_member" value="{{ $pelanggan->kontak_member }}" class="form-control">
                        </div>
                        <div>
                            <label>Alamat Member</label>
                            <input type="text" name="alamat_member" value="{{ $pelanggan->alamat_member }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
