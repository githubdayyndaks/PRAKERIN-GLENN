@extends('layouts.app')

@section('title', 'Detail Tipe Kamar')

@section('contents')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tipe Kamar</title>
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .invoice-container {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-container h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .invoice-container h2 {
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .invoice-container p {
            margin: 5px 0;
        }
        .invoice-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-container th, .invoice-container td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .invoice-container th {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <h1 class="font-bold text-2xl mb-4">Detail Tipe Kamar</h1>
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
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">NOMOR KAMAR</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->kode_daftarkamar }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Nama Tipe Kamar</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->nama_tipekamar }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Foto</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            <div class="max-w-xs">
                                <img src="{{ asset('uploads/'.$kamar->foto)}}" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Harga</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->harga }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Nama Penyewa</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->nama_penyewa }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Luas Kamar</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->luas }}
                        </td>
                    </tr>
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900 dark:text-gray-200">Status</th>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                            {{ $kamar->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

@endsection
