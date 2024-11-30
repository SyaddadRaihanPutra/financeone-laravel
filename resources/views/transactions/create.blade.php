@extends('layouts.custom-layout')
@section('title', 'Tambah Transaksi')
@section('content')
    <div class="container pt-12 mx-auto">
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <h1 class="text-2xl font-bold text-center">Tambah Transaksi</h1>
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                        <input type="number" name="amount" id="amount" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm" required>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm" required>
                            <option value="income">Pemasukan</option>
                            <option value="expense">Pengeluaran</option>
                        </select>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="description" id="description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm" required>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm" required>
                    </div>

                    <div class="col-span-2">
                        <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create Transaction</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
