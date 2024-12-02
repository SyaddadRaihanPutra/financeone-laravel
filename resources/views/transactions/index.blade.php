@extends('layouts.custom-layout')
@section('title', 'Riwayat Transaksi')
@section('content')
    <div class="container pt-12 mx-auto">
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <h1 class="text-2xl font-bold text-center">Riwayat Transaksi</h1>
            <a href="{{ route('transactions.export-pdf') }}"
                class="px-3 py-2 text-sm mt-5 inline-block text-white transition-all transform rounded-md bg-slate-700 hover:bg-slate-800 font-base"><i
                    class="ti ti-printer"></i> Cetak Laporan</a>
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-rounded scrollbar-thumb-gray-400 scrollbar-track-gray-200"
                style="-webkit-overflow-scrolling: touch; scrollbar-width: thin; scrollbar-color: gray-400 gray-200;">
                <table class="w-full mt-4 border border-gray-200 text-nowrap">
                    <thead>
                        <tr class="text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-500">
                            <th class="px-6 py-3 text-center">Tipe</th>
                            <th class="px-6 py-3 text-left">Jumlah</th>
                            <th class="px-6 py-3 text-left">Keterangan</th>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr
                                class="text-sm text-gray-700 transition-colors duration-200 border-b border-gray-200 cursor-pointer hover:bg-gray-100">
                                <td class="px-6 py-2">
                                    @if ($transaction->type === 'income')
                                        <div
                                            class="flex items-center justify-center px-2 py-1 text-xs font-semibold text-green-600 bg-white rounded-md ring-1 ring-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                                <path d="M3 10h18" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16l3 3l-3 3" />
                                                <path d="M7.005 15h.005" />
                                                <path d="M11 15h2" />
                                            </svg>
                                            <span class="ms-2">Income</span>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center justify-center px-2 py-1 text-xs font-semibold text-red-600 bg-white rounded-md ring-1 ring-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-refund">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                                <path d="M3 10h18" />
                                                <path d="M7 15h.01" />
                                                <path d="M11 15h2" />
                                                <path d="M16 19h6" />
                                                <path d="M19 16l-3 3l3 3" />
                                            </svg>
                                            <span class="ms-2">Expense</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-2 font-semibold">Rp
                                    {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-2">{{ $transaction->description }}</td>
                                <td class="px-6 py-2">{{ $transaction->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $transactions->links('pagination::tailwind-custom') }}
            </div>
        </div>
    </div>
@endsection
