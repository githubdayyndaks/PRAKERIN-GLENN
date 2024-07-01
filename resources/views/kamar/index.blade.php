@extends('layouts.app')

@section('title', 'List Kamar')

@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">List Kamar</h1>
    @if (auth()->user()->type == 'admin')
    <a href="{{ route('admin/kamar/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    @elseif(auth()->user()->type == 'supervisor')
    <a href="{{ route('supervisor/kamar/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
   @elseif(auth()->user()->type == 'petugas')
   <a href="{{ route('petugas/kamar/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    @endif
    <hr />
    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    @php
    $route = '';
    if (auth()->user()->type == 'admin') {
        $route = 'admin/kamar/invoice';
    } elseif (auth()->user()->type == 'supervisor') {
        $route = 'supervisor/kamar/invoice';
    } elseif (auth()->user()->type == 'petugas') {
        $route = 'petugas/kamar/invoice';
    }
@endphp

@if ($route)
@foreach($kamar as $rs)
    @if ($loop->first)
        <a href="{{ route($route, $rs->kode_daftarkamar) }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Invoice</a>
    @endif
@endforeach
@endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Kode Kamar</th>
                <th scope="col" class="px-6 py-3">Tipe Kamar</th>
                <th scope="col" class="px-6 py-3">Fasilitas</th>
                <th scope="col" class="px-6 py-3">Foto</th>
                <th scope="col" class="px-6 py-3">Harga</th>
                <th scope="col" class="px-6 py-3">Nama Penyewa</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($kamar->count() > 0)
            @foreach($kamar as $rs)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->iteration }}
                </th>
                <td>
                    {{ $rs->kode_daftarkamar }}
                </td>
                <td>
                    {{ $rs->nama_tipekamar }}
                </td>
                <td>
                    {{ $rs->fasilitas }}
                </td>
                <td>
                    <img src="{{ asset('uploads/'.$rs->foto) }}" class="mt-2 h-20">
                </td>
                <td>
                    {{ $rs->harga }}
                </td>
                <td>
                    {{ $rs->nama_penyewa }}
                </td>
                <td>
                    {{ $rs->status }}
                </td>
                <td class="w-36">
                    <div class="h-14 pt-5">
                        @if (auth()->user()->type == 'admin')
                        <a href="{{ route('admin/kamar/show', $rs->kode_daftarkamar) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('admin/kamar/edit', $rs->kode_daftarkamar)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('admin/kamar/destroy', $rs->kode_daftarkamar) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'supervisor')
                        <a href="{{ route('supervisor/kamar/show', $rs->kode_daftarkamar) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('supervisor/kamar/edit', $rs->kode_daftarkamar)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('supervisor/kamar/destroy', $rs->kode_daftarkamar) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'petugas')
                        <a href="{{ route('petugas/kamar/show', $rs->kode_daftarkamar) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('petugas/kamar/edit', $rs->kode_daftarkamar)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('petugas/kamar/destroy', $rs->kode_daftarkamar) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @endif

                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center" colspan="5">Kamar Kosong</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
