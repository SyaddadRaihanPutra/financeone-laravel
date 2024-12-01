@extends('layouts.custom-layout')
@section('title', 'Dashboard')
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
        <div class="p-5 mt-5 transition-all bg-white shadow rounded-xl hover:shadow-xl ring-1 ring-slate-100">
            <div class="flex items-start justify-between p-3 bg-slate-100 rounded-xl">
                <div>
                    <p class="text-lg font-semibold text-gray-600">Total saldo</p>
                    <p id="totalBalance" class="text-2xl font-semibold text-slate-900">******</p>
                </div>
                <button id="toggleVisibility" class="text-2xl focus:outline-none">
                    <i id="eyeIcon" class="text-gray-600 ti ti-eye-off"></i>
                </button>
            </div>
            <div class="grid grid-cols-2 gap-3 mt-4">
                <a href="#">
                    <div class="px-4 py-2 rounded-2xl bg-slate-100">
                        <i class="text-green-600 ti ti-arrow-down-left"></i>
                        <span class="text-sm font-semibold text-gray-600">Pemasukan</span>
                        <h1 id="totalIncome" class="text-xl font-bold text-green-600">******</h1>
                    </div>
                </a>
                <a href="#">
                    <div class="px-4 py-2 rounded-2xl bg-slate-100">
                        <i class="text-red-600 ti ti-arrow-up-right"></i>
                        <span class="text-sm font-semibold text-gray-600">Pengeluaran</span>
                        <h1 id="totalExpense" class="text-xl font-bold text-red-600">******</h1>
                    </div>
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 mt-7 lg:grid-cols-2">
            <div class="p-5 bg-white shadow rounded-xl ring-1 ring-slate-100">
                <div id="loading" class="flex items-center justify-center h-40 bg-white">
                    <div class="w-12 h-12 border-t-4 border-indigo-600 rounded-full animate-spin"></div>
                    <span class="ml-4 text-xl font-medium text-indigo-600">Sedang mengambil data...</span>
                </div>
                <div id="dashboard-content" class="hidden">
                    <h2 class="mb-1 text-lg font-semibold">Statistik keuangan anda</h2>
                    <p class="mb-4 text-sm text-gray-600">Grafik ini menampilkan total pemasukan dan pengeluaran anda selama
                        7 hari
                        terakhir.</p>
                    <div class="relative p-6 rounded-lg bg-slate-100">
                        <div id="loading"
                            class="absolute inset-0 z-10 flex items-center justify-center hidden bg-gray-800 bg-opacity-50">
                            <div class="w-12 h-12 border-t-4 border-blue-500 rounded-full loader animate-spin"></div>
                        </div>
                        <canvas id="lineChart" class="w-full h-80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const totalBalance = document.getElementById('totalBalance');
            const totalIncome = document.getElementById('totalIncome');
            const totalExpense = document.getElementById('totalExpense');
            const loading = document.getElementById('loading');
            const content = document.getElementById('dashboard-content');
            const toggleVisibilityButton = document.getElementById('toggleVisibility');
            const eyeIcon = document.getElementById('eyeIcon');

            // Fetch data dynamically
            fetch('{{ route('dashboard.getApi') }}')
                .then(response => response.json())
                .then(data => {
                    // Update balance, income, and expense
                    totalBalance.textContent = data.totalBalance ?
                        `Rp ${parseInt(data.totalBalance).toLocaleString()}` : '******';
                    totalIncome.textContent = data.totalIncome ?
                        `Rp ${parseInt(data.totalIncome).toLocaleString()}` : '******';
                    totalExpense.textContent = data.totalExpense ?
                        `Rp ${parseInt(data.totalExpense).toLocaleString()}` : '******';

                    // Prepare chart data (taking the last 7 days of data)
                    const labels = data.seriesData.map(item =>
                    `${item.date}`); // Tanggal yang ditampilkan pada grafik
                    const incomeData = data.seriesData.map(item => parseFloat(item.total_income));
                    const expenseData = data.seriesData.map(item => parseFloat(item.total_expense));

                    // Render chart using Chart.js
                    const ctx = document.getElementById('lineChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Income',
                                    data: incomeData,
                                    borderColor: '#4CAF50',
                                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                                    fill: true,
                                    tension: 0.3,
                                    borderWidth: 2,
                                },
                                {
                                    label: 'Expense',
                                    data: expenseData,
                                    borderColor: '#F44336',
                                    backgroundColor: 'rgba(244, 67, 54, 0.2)',
                                    fill: true,
                                    tension: 0.3,
                                    borderWidth: 2,
                                }
                            ],
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                            },
                        },
                    });

                    // Hide loading and show content
                    loading.classList.add('hidden');
                    content.classList.remove('hidden');
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    alert("Failed to load data.");
                });

            // Set initial visibility to true
            totalBalance.style.display = 'block';
            totalIncome.style.display = 'block';
            totalExpense.style.display = 'block';
            eyeIcon.classList.remove('ti-eye-off');
            eyeIcon.classList.add('ti-eye');
            localStorage.setItem('balanceVisibility', 'true');

            // Toggle visibility on button click
            toggleVisibilityButton.addEventListener('click', function() {
                const isCurrentlyVisible = totalBalance.style.display !== 'none';

                if (isCurrentlyVisible) {
                    totalBalance.style.display = 'none';
                    totalIncome.style.display = 'none';
                    totalExpense.style.display = 'none';
                    eyeIcon.classList.remove('ti-eye');
                    eyeIcon.classList.add('ti-eye-off');
                    localStorage.setItem('balanceVisibility', 'false');
                } else {
                    totalBalance.style.display = 'block';
                    totalIncome.style.display = 'block';
                    totalExpense.style.display = 'block';
                    eyeIcon.classList.remove('ti-eye-off');
                    eyeIcon.classList.add('ti-eye');
                    localStorage.setItem('balanceVisibility', 'true');
                }
            });
        });
    </script>
@endsection
