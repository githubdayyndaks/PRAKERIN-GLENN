@extends('layouts.app')

@section('title', 'List Lantai')

@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">List Lantai</h1>
    @if (auth()->user()->type == 'admin')
    <a href="{{ route('admin/lantai/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    @elseif(auth()->user()->type == 'supervisor')
    <a href="{{ route('supervisor/lantai/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
   @elseif(auth()->user()->type == 'petugas')
   <a href="{{ route('petugas/lantai/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
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
        $route = 'admin/lantai/invoice';
    } elseif (auth()->user()->type == 'supervisor') {
        $route = 'supervisor/lantai/invoice';
    } elseif (auth()->user()->type == 'petugas') {
        $route = 'petugas/lantai/invoice';
    }
@endphp

@if ($route)
@foreach($lantai as $rs)
    @if ($loop->first)
        <a href="{{ route($route, $rs->lantai_id) }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Invoice</a>
    @endif
@endforeach
@endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">ID LANTAI</th>
                <th scope="col" class="px-6 py-3">LANTAI</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($lantai->count() > 0)
            @foreach($lantai as $rs)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $loop->iteration }}
                </th>


                <td>
                    {{ $rs->id }}
                </td>
                <td>
                    {{ $rs->lantai }}
                </td>
                <td class="w-36">
                    <div class="h-14 pt-5">
                        @if (auth()->user()->type == 'admin')
                        <a href="{{ route('admin/lantai/show', $rs->lantai_id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('admin/lantai/edit', $rs->lantai_id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('admin/lantai/destroy', $rs->lantai_id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'supervisor')
                        <a href="{{ route('supervisor/lantai/show', $rs->lantai_id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('supervisor/lantai/edit', $rs->lantai_id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('supervisor/lantai/destroy', $rs->lantai_id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'petugas')
                        <a href="{{ route('petugas/lantai/show', $rs->lantai_id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('petugas/lantai/edit', $rs->lantai_id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('petugas/lantai/destroy', $rs->lantai_id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
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
                <td class="text-center" colspan="5">Product not found</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
