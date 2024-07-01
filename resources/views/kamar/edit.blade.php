@extends('layouts.app')

@section('title', 'Edit kamar')

@section('contents')
    <h1 class="font-bold text-2xl ml-3">Edit kamar</h1>
    <hr />

    <div class="card-body max-w-md mx-auto">
        <form action="
         @if (auth()->user()->type == 'admin')
            {{ route('admin/kamar/update', $kamar->kode_daftarkamar) }}
         @elseif (auth()->user()->type == 'supervisor')
            {{ route('supervisor/kamar/update', $kamar->kode_daftarkamar) }}
         @elseif (auth()->user()->type == 'petugas')
            {{ route('petugas/kamar/update', $kamar->kode_daftarkamar) }}
         @endif
        "
        method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Tipe Kamar</label>
                <div class="mt-2">
                    <select name="tipeKamar" id="tipeKamar" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Pilih Tipe Kamar</option>
                        @foreach($tipeKamar as $tk)
                            <option value="{{ $tk->kode_tipekamar }}" @if($tk->kode_tipekamar == $kamar->kode_tipekamar) selected @endif>{{ $tk->nama_tipekamar }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Harga</label>
                <div class="mt-2">
                    <input type="text" name="harga" id="harga" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $kamar->harga }}">
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Luas</label>
                <div class="mt-2">
                    <input type="text" name="luas" id="luas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $kamar->luas }}">
                </div>
            </div>
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                <div class="mt-2">
                    <select name="status" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="">Pilih Status</option>
                        <option value="Tersedia" @if($kamar->status == 'Tersedia') selected @endif>Tersedia</option>
                        <option value="Disewa" @if($kamar->status == 'Disewa') selected @endif>Disewa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </form>
    </div>
@endsection
