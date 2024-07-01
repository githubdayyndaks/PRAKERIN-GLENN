@extends('layouts.app')

@section('title', 'Profile Settings')

@section('contents')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<hr />
<form method="POST" enctype="multipart/form-data" action="{{ route('admin.update') }}">
    @csrf
    @method('PUT') <!-- This directive is crucial for sending a PUT request -->
    <div>
        <label class="label">
            <span class="text-base label-text">Name</span>
        </label>
        <input name="name" type="text" value="{{ $user->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    </div>
    <div>
        <label class="label">
            <span class="text-base label-text">Email</span>
        </label>
        <input name="email" type="text" value="{{ $user->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    </div>
    <div>
        <label class="label">
            <span class="text-base label-text">Alamat</span>
        </label>
        <input name="alamat" type="text" value="{{ $user->alamat }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
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
    <div>
        <label class="label">
            <span class="text-base label-text">Nomor Handphone</span>
        </label>
        <input name="nohp" type="text" value="{{ $user->nohp }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
    </div>
    <div class="mt-4">
        <label class="label">
            <span class="text-base label-text">Upload Foto</span>
        </label>
        <input name="foto" type="file" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />

        <h1>Foto Sebelumnya</h1>
        @if ($user->foto)
            <img src="{{ asset('uploads/' . $user->foto) }}" alt="User Photo" class="w-32 h-32 object-cover mt-2">
        @endif
    </div>
    <div class="mt-6">
        <button type="submit" class="btn btn-block">Save Profile</button>
    </div>
</form>
@endsection
