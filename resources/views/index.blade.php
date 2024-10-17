@extends('layout.app')
@section('title', 'MoveIt')
@section('content')
    <div class="container mx-auto flex flex-col justify-center items-center mt-10 max-w-7xl p-2 mb-20">
        <div class="grid grid-cols-2 gap-2 mb-5">
            <a href="/" class="bg-sky-800 p-2 rounded-lg text-xl text-white font-semibold shadow-md">Tracking</a>
            <button class="bg-white p-2 rounded-lg text-xl text-black shadow-md">Cek Tarif</button>
        </div>
        <div class="container bg-white flex flex-col p-8 rounded-lg shadow-lg">
            <h1 class="text-7xl font-bold text-sky-950 mb-8 text-center">Pelacakan</h1>
            <form action="{{ route('track') }}" class="w-full flex flex-col justify-center items-center mb-5" method="post">
                @csrf
                <span class="text-xl text-gray-600 tracking-wide mb-5">Pilih Ekspedisi</span>
                <select name="courier"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 text-center mb-5 z-50">
                    <option selected>-- Pilih Ekspedisi --</option>
                    @foreach ($data as $d)
                        <option value="{{ $d->code }}">{{ $d->description }}</option>
                    @endforeach
                </select>
                <span class="text-xl text-gray-600 tracking-wide mb-5">Masukkan nomor resi mu</span>
                <input name="awb" type="text"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 mb-5">
                </input>
                <button type="submit" class="bg-red-800 p-4 text-white font-semibold rounded-3xl">Lacak Pengiriman</button>
            </form>
            @if (isset($resi->data->summary) && isset($resi->data->detail))
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-2 border-gray-400">
                    <table class="w-full text-sm text-left text-gray-800 ">
                        <thead class="text-xs text-gray-800 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No. AWB
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kurir
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kota Tujuan
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Penerima Barang
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal Diterima
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $resi->data->summary->awb }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $resi->data->summary->courier }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->data->detail->destination }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->data->detail->receiver }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($resi->data->summary->status === 'DELIVERED')
                                        {{ $resi->data->summary->date }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->data->summary->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>


                            {{-- <tr class="bg-white">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $resi->summary->awb }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $resi->summary->courier }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->detail->destination }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->detail->receiver }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->summary->date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $resi->summary->status }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Lihat
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 inline-block">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection
