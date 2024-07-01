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
    <h1 class="font-bold text-2xl mb-4">Lantai Details</h1>
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

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Lantai ID</th>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                        {{ $lantai->lantai_id ?? 'Data not provided' }}
                    </td>
                </tr>
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Lantai</th>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                        {{ $lantai->lantai ?? 'Data not provided' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
