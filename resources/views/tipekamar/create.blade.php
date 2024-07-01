@extends('layouts.app')

@section('title', 'Home Product List')

@section('contents')
<div class="card-body max-w-md mx-auto">
    <form action="
    @if (auth()->user()->type == 'admin')
    {{ route('admin/tipekamar/store') }}
    @elseif (auth()->user()->type == 'supervisor')
    {{ route('supervisor/tipekamar/store') }}
    @elseif (auth()->user()->type == 'petugas')
    {{ route('petugas/tipekamar/store') }}
    @endif

    " method="POST" enctype="multipart/form-data" class="space-y-4 md:space-y-6">
        @csrf
        <div>
            <label for="kode_tipekamar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Tipe Kamar</label>
            <input type="text" id="kode_tipekamar" name="kode_tipekamar" value="{{ $kodeTipeKamar }}" readonly>

            @error('kode_tipekamar')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="nama_tipekamar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Tipe Kamar</label>
            <input type="text" name="nama_tipekamar" id="nama_tipekamar" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('nama_tipekamar')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="fasilitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fasilitas</label>
            <input type="text" name="fasilitas" id="fasilitas" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('fasilitas')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
            <input type="file" name="foto" id="foto" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            @error('foto')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex items-start">
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Data</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var kodeTipeKamarInput = document.getElementById('kode_tipekamar');

    // Hanya setel nomor urut baru jika tidak ada nilai di input
    if (!kodeTipeKamarInput.value) {
        // Ambil nilai kode_tipekamar terakhir dari input (misalnya dari backend)
        var lastKodeTipeKamar = kodeTipeKamarInput.value;

        // Ambil nomor urut terakhir
        var lastNumber = parseInt(lastKodeTipeKamar.substring(3)) || 0;

        // Tambahkan 1 ke nomor urut terakhir
        var nextNumber = lastNumber + 1;

        // Format nomor urut berikutnya menjadi 3 digit dengan 0 di depan jika perlu
        var formattedNumber = nextNumber.toString().padStart(3, '0');

        // Hasilkan kode tipe kamar baru
        var newKodeTipeKamar = 'TK-' + formattedNumber;

        // Tetapkan nilai kode_tipekamar baru ke input
        kodeTipeKamarInput.value = newKodeTipeKamar;
    }
});
</script>
@endsection
