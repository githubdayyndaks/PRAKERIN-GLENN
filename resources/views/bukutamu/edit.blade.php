@extends('layouts.app')

@section('title', 'Edit users')

@section('contents')
<h1 class="mb-0">Edit Data User</h1>
<hr />
<div class="card-body max-w-md mx-auto">
    <form action="
    @if (auth()->user()->type == 'admin')
    {{ route('admin/user/update', $users->id) }}
    @elseif (auth()->user()->type == 'supervisor')
    {{ route('supervisor/user/update', $users->id) }}
    @elseif (auth()->user()->type == 'petugas')
    {{ route('petugas/user/update', $users->id) }}
    @endif

    " method="POST">
        @csrf
        @method('PUT')
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Nama User</label>
            <div class="mt-2">
                <input type="text" name="name" id="name" value="{{ $users->name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Email users</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" value="{{ $users->email }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Alamat</label>
            <div class="mt-2">
                <textarea name="alamat" placeholder="Alamat" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $users->alamat }}</textarea>
            </div>
        </div>
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">No HP</label>
            <div class="mt-2">
                <input id="nohp" name="nohp" value="{{ $users->nohp }}" type="number" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div>
            <label class="label">
                <span class="text-base label-text">Gender</span>
            </label>
            <select name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
    </form>
</div>
@endsection
