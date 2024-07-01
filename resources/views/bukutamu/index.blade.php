@extends('layouts.app')

@section('title', 'Home Product List')

@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">Daftar User</h1>
    @if (auth()->user()->type == 'admin')
    <a href="{{ route('admin/user/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    @elseif(auth()->user()->type == 'supervisor')
    <a href="{{ route('supervisor/user/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
   @elseif(auth()->user()->type == 'petugas')
   <a href="{{ route('petugas/user/create') }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
    @endif

    @php
    $route = '';
    if (auth()->user()->type == 'admin') {
        $route = 'admin/user/invoice';
    } elseif (auth()->user()->type == 'supervisor') {
        $route = 'supervisor/user/invoice';
    } elseif (auth()->user()->type == 'petugas') {
        $route = 'petugas/user/invoice';
    }
@endphp

@if ($route)
@foreach($users as $rs)
    @if ($loop->first)
        <a href="{{ route($route, $rs->id) }}" class="text-white float-right bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Invoice</a>
    @endif
@endforeach
@endif

    <hr />
    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Role</th>
                @if (auth()->user()->type != 'pengguna')
                <th scope="col" class="px-6 py-3">Action</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @if($users->count() > 0)
            @foreach($users as $rs)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="col" class="px-6 py-3">
                    {{ $loop->iteration }}
                </th>
                <td scope="col" class="px-6 py-3">
                    {{ $rs->name }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $rs->email }}
                </td>
                <td scope="col" class="px-6 py-3">
                    {{ $rs->type }}
                </td>
                <td class="w-36">
                    <div class="h-14 pt-5">
                        @if (auth()->user()->type == 'admin')
                        <a href="{{ route('admin/user/show', $rs->id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('admin/user/edit', $rs->id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('admin/user/destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'supervisor')
                        <a href="{{ route('supervisor/user/show', $rs->id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('supervisor/user/edit', $rs->id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('supervisor/user/destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                        @elseif (auth()->user()->type == 'petugas')
                        <a href="{{ route('petugas/user/show', $rs->id) }}" class="text-blue-800">Detail</a> |
                        <a href="{{ route('petugas/user/edit', $rs->id)}}" class="text-green-800 pl-2">Edit</a> |
                        <form action="{{ route('petugas/user/destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="float-right text-red-800">
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
                <td class="text-center" colspan="5">Tidak ada data yang ada</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
