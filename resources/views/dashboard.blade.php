@extends('layouts.custom-layout')

@section('content')
    <div class="container pt-12 mx-auto">
        <h1 class="pt-8 text-lg font-light">Selamat @if (now()->setTimezone('Asia/Jakarta')->hour >= 0 && now()->setTimezone('Asia/Jakarta')->hour < 12)
                Pagi
            @elseif (now()->setTimezone('Asia/Jakarta')->hour >= 12 && now()->setTimezone('Asia/Jakarta')->hour < 18)
                Siang
            @else
                Malam
            @endif
        </h1>
        <h1 class="text-xl font-semibold sm:text-2xl">
            {{ Auth::user()->fullname }}
        </h1>
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <div class="p-3 bg-slate-100 rounded-xl">
                <p class="text-lg font-semibold text-gray-600">Total saldo</p>
                <p class="text-2xl font-semibold text-slate-900">Rp2.333.333</p>
            </div>
            <div class="flex gap-2 mt-3">
                <div class="inline-block px-2 py-1 rounded-full bg-slate-100">
                    <i class="text-red-600 ti ti-arrow-up-right"></i>
                    <span class="text-sm font-semibold text-gray-600">Pengeluaran</span>
                </div>
                <div class="inline-block px-2 py-1 rounded-full bg-slate-100">
                    <i class="text-green-600 ti ti-arrow-down-left"></i>
                    <span class="text-sm font-semibold text-gray-600">Pemasukan</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="grid grid-cols-2 gap-4 py-4 mt-4 sm:px-0">
            <div class="p-4 transition-all bg-white shadow-lg ring-1 ring-gray-300 rounded-xl hover:shadow-xl">
                <h1>Total Income</h1>
                <h1 class="pt-3 text-2xl font-semibold text-green-600">
                    Rp N/A
                    <div class="pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trending-up">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 17l6 -6l4 4l8 -8" />
                            <path d="M14 7l7 0l0 7" />
                        </svg>
                    </div>
                </h1>
            </div>
            <div class="p-4 transition-all bg-white shadow-lg ring-1 ring-gray-300 rounded-xl hover:shadow-xl">
                <h1>Total Expense</h1>
                <h1 class="pt-3 text-2xl font-semibold text-red-600">
                    Rp n/A
                    <div class="pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trending-down">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 7l6 6l4 -4l8 8" />
                            <path d="M21 10l0 7l-7 0" />
                        </svg>
                    </div>
                </h1>
            </div>
        </div>
        <div class="px-6 py-4 bg-white lg:px-8">
            <div class="grid">
                <apexchart type="bar" :options="chartOptions" :series="chartData.series" height="350" />
            </div>
        </div>
    </div>
@endsection
