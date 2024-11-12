<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Karyawan') }}
        </h2>
    </x-slot>

    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="nama_karyawan">Nama Karyawan:</label>
        <input type="text" name="nama_karyawan" id="nama_karyawan" value="{{ $karyawan->nama_karyawan }}" required>
        <br>
        
        <label for="kontak_karyawan">Kontak Karyawan:</label>
        <input type="text" name="kontak_karyawan" id="kontak_karyawan" value="{{ $karyawan->kontak_karyawan }}">
        <br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $karyawan->email }}" required>
        <br>
        
        <button type="submit">Update</button>
    </form>
</x-app-layout>
