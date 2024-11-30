@extends('layouts.custom-layout')
@section('title', 'Riwayat Transaksi')
@section('content')
    <div class="container pt-12 mx-auto">
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <h1 class="text-2xl font-bold text-center">Riwayat Transaksi</h1>
            <div class="overflow-x-auto">
                <table class="w-full mt-4 border border-gray-200 rounded-md">
                    <thead>
                        <tr class="text-sm font-medium text-gray-700 bg-gray-50">
                            <th class="px-6 py-3 text-left">Amount</th>
                            <th class="px-6 py-3 text-left">Type</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="text-sm text-gray-700 border-b border-gray-200">
                                <td class="px-6 py-3">{{ $transaction->amount }}</td>
                                <td class="px-6 py-3">{{ $transaction->type }}</td>
                                <td class="px-6 py-3">{{ $transaction->description }}</td>
                                <td class="px-6 py-3">{{ $transaction->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection
