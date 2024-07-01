@extends('layouts.app')

@section('title', 'Edit Tipe Kamar')

@section('contents')
<h1 class="mb-0">Edit Tipe Kamar</h1>
<hr />
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <form action="
        @if (auth()->user()->type == 'admin')
        {{ route('admin/tipekamar/update', $tipekamar->kode_tipekamar) }}
        @elseif (auth()->user()->type == 'supervisor')
        {{ route('supervisor/tipekamar/update', $tipekamar->kode_tipekamar) }}
        @elseif (auth()->user()->type == 'petugas')
        {{ route('petugas/tipekamar/update', $tipekamar->kode_tipekamar) }}
        @endif

        " method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Kode Tipe Kamar</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" value="{{ $tipekamar->kode_tipekamar }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" readonly>
                </div>
            </div>

            <div>
                <label for="nama_tipekamar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Tipe Kamar</label>
                <input type="text" name="nama_tipekamar" id="nama_tipekamar" value="{{ $tipekamar->nama_tipekamar }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                @error('nama_tipekamar')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="fasilitas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fasilitas</label>
                <input type="text" name="fasilitas" id="fasilitas" value="{{ $tipekamar->fasilitas }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                @error('fasilitas')
                <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                <input type="file" name="foto" id="foto" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($tipekamar->foto)
                    <input type="hidden" name="foto_existing" value="{{ $tipekamar->foto }}">
                    <img src="{{ asset('uploads/'.$tipekamar->foto) }}" class="mt-2 h-20">
                @endif
                @error('foto')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
        </form>
    </div>
</div>
@endsection
