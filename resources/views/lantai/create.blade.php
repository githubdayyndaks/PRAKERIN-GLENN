@extends('layouts.app')

@section('title', 'Create Lantai')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Add Lantai</h1>
<hr />

    <div  class="card-body max-w-md mx-auto">
        <form action="
        @if (auth()->user()->type == 'admin')
        {{ route('admin/lantai/store') }}
        @elseif (auth()->user()->type == 'supervisor')
        {{ route('supervisor/lantai/store') }}
        @elseif (auth()->user()->type == 'petugas')
        {{ route('petugas/lantai/store') }}
        @endif
        " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Lantai</label>
                <div class="mt-2">
                    <input type="text" name="lantai" id="lantai" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <button type="submit" class="flex w-full justify-center mt-10 rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
        </form>
    </div>
@endsection
