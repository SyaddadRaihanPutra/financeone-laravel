@extends('layouts.custom-layout')
@section('title', 'Beranda')
@section('content')
    <div class="relative max-w-4xl mx-auto text-center py-28">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
            Kelola Keuangan Anda dengan Mudah dan Efisien!
        </h1>
        <p class="mt-6 text-lg leading-8 text-slate-700">
            Catat pemasukan dan pengeluaran, buat anggaran, dan lacak laporan keuangan Anda dalam satu aplikasi!
        </p>
        <div class="flex justify-center gap-4 mt-10">
            <a href="#"
                class="px-6 py-3 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                Coba Gratis Sekarang
            </a>
            <a href="#features"
                class="px-6 py-3 text-sm font-semibold text-indigo-600 bg-white border border-indigo-300 rounded-lg hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:ring-offset-2">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
    <!-- Section Fitur Utama -->
    <section id="features" class="py-20 ">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Fitur Unggulan Kami
                </h2>
                <p class="mt-4 text-lg text-slate-700">
                    Dirancang untuk membantu Anda mengelola keuangan dengan lebih baik, mudah, dan cepat.
                </p>
            </div>
            <div class="grid grid-cols-1 mt-16 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8">
                <!-- Fitur 1 -->
                <div class="text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto text-indigo-600 bg-indigo-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Catatan Transaksi
                    </h3>
                    <p class="mt-4 text-slate-700">
                        Mudah mencatat pemasukan dan pengeluaran harian Anda dalam hitungan detik.
                    </p>
                </div>
                <!-- Fitur 2 -->
                <div class="text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto text-indigo-600 bg-indigo-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12h4l3 8l4 -16l3 8h4" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Laporan Keuangan
                    </h3>
                    <p class="mt-4 text-slate-700">
                        Lihat laporan keuangan Anda dalam grafik yang menarik dan mudah dipahami.
                    </p>
                </div>
                <!-- Fitur 3 -->
                <div class="text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto text-indigo-600 bg-indigo-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                            <path d="M3 10l18 0" />
                            <path d="M7 15l.01 0" />
                            <path d="M11 15l2 0" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-900">
                        Anggaran dan Perencanaan
                    </h3>
                    <p class="mt-4 text-slate-700">
                        Tetapkan anggaran Anda dengan mudah untuk mencapai target finansial.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
