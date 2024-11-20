<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Loyalty Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('loyalitas.store') }}" method="POST">
                        @csrf
                        <div>
                            <label>Nama Member</label>
                            <input type="text" name="nama_member" required class="form-control">
                        </div>
                        <div>
                            <label>Kontak Member</label>
                            <input type="text" name="kontak_member" class="form-control">
                        </div>
                        <div>
                            <label>Alamat Member</label>
                            <input type="text" name="alamat_member" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
