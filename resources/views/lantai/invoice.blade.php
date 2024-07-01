@extends('layouts.app')

@section('title', 'User Details')

@section('contents')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .invoice-container, .invoice-container * {
            visibility: visible;
        }
        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none;
        }
    }
</style>

<div class="invoice-container p-6">
    <h1 class="font-bold text-2xl mb-4">User Details</h1>
    <hr />
    <div class="mt-4 mb-4 text-right">
        <button class="no-print" style="display: inline-block; font-weight: 400; color: #fff; text-align: center; vertical-align: middle; user-select: none; background-color: #007bff; border: 1px solid #007bff; padding: 0.375rem 0.75rem; font-size: 1rem; line-height: 1.5; border-radius: 0.25rem; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;" onclick="window.print()">Print this page</button>
    </div>
    <div class="border-b border-gray-900/10 pb-12">
        <div class="flex items-center mb-4">
            <img src="{{ asset('uploads/' . $settings->foto) }}" alt="Company Photo" class="w-16 h-16 object-cover mr-4">
            <div>
                <h1 class="font-bold text-gray-900 text-lg">{{ $settings->nama_perusahaan }}</h1>
                <p class="text-gray-700">{{ $settings->deskripsi }}</p>
            </div>
        </div>
        <div class="mb-4">
            <h2 class="font-bold text-gray-900 text-lg">Address</h2>
            <p class="text-gray-700">Internasional, Jl. Terusan Sekolah Jl. Antapani Lama No.6 No. 1, Cicaheum, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40274</p>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">ID LANTAI</th>
                    <th scope="col" class="px-6 py-3">LANTAI</th>
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
</div>
@endsection
