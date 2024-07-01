@extends('layouts.app')

@section('title', 'Create kamar')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Add kamar</h1>
<hr />

<div class="card-body max-w-md mx-auto">
    <form action="
    @if (auth()->user()->type == 'admin')
    {{ route('admin/kamar/store') }}
    @elseif (auth()->user()->type == 'supervisor')
    {{ route('supervisor/kamar/store') }}
    @elseif (auth()->user()->type == 'petugas')
    {{ route('petugas/kamar/store') }}
    @endif
    " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Lantai</label>
            <div class="mt-2">
                <select name="lantai" id="lantai" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Lantai</option>
                    @foreach($lantai as $l)
                        <option value="{{ $l->lantai_id }}">{{ $l->lantai }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Tipe Kamar</label>
            <div class="mt-2">
                <select name="tipeKamar" id="tipeKamar" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Tipe Kamar</option>
                    @foreach($tipeKamar as $tk)
                        <option value="{{ $tk->kode_tipekamar }}">{{ $tk->nama_tipekamar }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Harga</label>
            <div class="mt-2">
                <input type="text" name="harga" id="harga" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Luas</label>
            <div class="mt-2">
                <input type="text" name="luas" id="luas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Status</label>
            <div class="mt-2">
                <select name="status" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">Pilih Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Disewa">Disewa</option>
                </select>
            </div>
        </div>
        <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
    </form>
</div>
@endsection
