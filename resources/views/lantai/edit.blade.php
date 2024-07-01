@extends('layouts.app')

@section('title', 'Edit lantai')

@section('contents')
<h1 class="mb-0">Edit Lantai</h1>
<hr />
<div class="card-body max-w-md mx-auto">
    <form action="
    @if (auth()->user()->type == 'admin')
    {{ route('admin/lantai/update', $lantai->id) }}
    @elseif (auth()->user()->type == 'supervisor')
    {{ route('supervisor/lantai/update', $lantai->id) }}
    @elseif (auth()->user()->type == 'petugas')
    {{ route('petugas/lantai/update', $lantai->id) }}
    @endif

    " method="POST">
        @csrf
        @method('PUT')
        <div class="sm:col-span-4">
            <label class="block text-sm font-medium leading-6 text-gray-900">Lantai</label>
            <div class="mt-2">
                <input type="text" name="lantai" id="lantai" value="{{ $lantai->lantai }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
        <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
    </form>
</div>
@endsection
