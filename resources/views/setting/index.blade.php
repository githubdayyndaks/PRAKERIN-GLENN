@extends('layouts.app')

@section('title', 'Edit Settings')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Edit Settings</h1>
<hr />
@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif
<form action="
@if (auth()->user()->type == 'admin')
{{ route('admin/setting/update') }}
@elseif (auth()->user()->type == 'supervisor')
{{ route('supervisor/setting/update') }}
@endif

" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="border-b border-gray-900/10 pb-12 mt-4">
        <div class="mt-4">
            <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ $settings->nama_perusahaan ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-800 dark:text-gray-200">
            @error('nama_perusahaan')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-800 dark:text-gray-200">{{ $settings->deskripsi ?? '' }}</textarea>
            @error('deskripsi')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-4">
            <label for="foto" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Foto</label>
            @if ($settings->foto)
                <img src="{{ asset('uploads/' . $settings->foto) }}" alt="Company Photo" class="w-32 h-32 object-cover mt-2">
            @endif
            <input type="file" name="foto" id="foto" class="mt-1 block w-full text-gray-900 dark:text-gray-200">
            @error('foto')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-600">Update</button>
        </div>
    </div>
</form>
@endsection
