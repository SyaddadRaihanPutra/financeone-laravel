@extends('layouts.custom-layout')
@section('title', 'Dashboard')
@section('content')
    <div class="container pt-12 mx-auto pb-40">
        @if (session('success'))
            <div class="bg-green-500 text-white font-bold px-4 py-2 rounded-md shadow-md">
                {{ session('success') }}
            </div>
        @endif

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
        <div class="p-5 mt-5 transition-all bg-white shadow rounded-xl ring-1 ring-slate-100">
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
                        3 hari
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
        <div class="grid grid-cols-1 gap-6 mt-7 lg:grid-cols-2">
            <div class="p-5 bg-white shadow rounded-xl ring-1 ring-slate-100">
                <div id="loading-transactions" class="flex items-center justify-center h-40 bg-white">
                    <div class="w-12 h-12 border-t-4 border-indigo-600 rounded-full animate-spin"></div>
                    <span class="ml-4 text-xl font-medium text-indigo-600">Sedang mengambil data...</span>
                </div>
                <div id="transactions-content" class="hidden">
                    <h2 class="mb-1 text-lg font-semibold">Riwayat transaksi anda</h2>
                    <p class="mb-4 text-sm text-gray-600">Menampilkan 5 transaksi terakhir anda.</p>
                    <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-rounded scrollbar-thumb-gray-400 scrollbar-track-gray-200"
                    style="-webkit-overflow-scrolling: touch; scrollbar-width: thin; scrollbar-color: gray-400 gray-200;">
                        <table class="w-full mt-4 border border-gray-200 text-nowrap" id="transactions-table">
                            <thead>
                                <tr class="text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-blue-500">
                                    <th class="px-6 py-3 text-center">Tipe</th>
                                    <th class="px-6 py-3 text-left">Jumlah</th>
                                    <th class="px-6 py-3 text-left">Keterangan</th>
                                    <th class="px-6 py-3 text-left">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
            const loadingTransactions = document.getElementById('loading-transactions');
            const transactionsContent = document.getElementById('transactions-content');
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

            // Fetch transaction data dynamically
            fetch('{{ route('transactions.getApi') }}')
                .then(response => response.json())
                .then(data => {
                    const transactionsTableBody = document.querySelector('#transactions-table tbody');
                    transactionsTableBody.innerHTML = ''; // Clear existing rows

                    if (data.transactions.length === 0) {
                        const emptyRow = document.createElement('tr');
                        const emptyCell = document.createElement('td');
                        emptyCell.setAttribute('colspan', '4');
                        emptyCell.classList.add('px-6', 'py-2', 'text-center', 'text-gray-500');
                        emptyCell.textContent = 'No transactions found.';
                        emptyRow.appendChild(emptyCell);
                        transactionsTableBody.appendChild(emptyRow);
                    } else {
                        data.transactions.forEach(transaction => {
                            const row = document.createElement('tr');
                            row.classList.add('text-sm', 'text-gray-700', 'transition-colors',
                                'duration-200', 'border-b', 'border-gray-200', 'cursor-pointer',
                                'hover:bg-gray-100');

                            const typeCell = document.createElement('td');
                            typeCell.classList.add('px-6', 'py-2');
                            if (transaction.type === 'income') {
                                typeCell.innerHTML = `
                                    <div class="flex items-center justify-center px-2 py-1 text-xs font-semibold text-green-600 bg-white rounded-md ring-1 ring-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                            <path d="M3 10h18" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16l3 3l-3 3" />
                                            <path d="M7.005 15h.005" />
                                            <path d="M11 15h2" />
                                        </svg>
                                        <span class="ms-2">Income</span>
                                    </div>
                                `;
                            } else {
                                typeCell.innerHTML = `
                                    <div class="flex items-center justify-center px-2 py-1 text-xs font-semibold text-red-600 bg-white rounded-md ring-1 ring-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-refund">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                            <path d="M3 10h18" />
                                            <path d="M7 15h.01" />
                                            <path d="M11 15h2" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16l-3 3l3 3" />
                                        </svg>
                                        <span class="ms-2">Expense</span>
                                    </div>
                                `;
                            }
                            row.appendChild(typeCell);

                            const amountCell = document.createElement('td');
                            amountCell.classList.add('px-6', 'py-2', 'font-semibold');
                            amountCell.textContent = `Rp ${parseInt(transaction.amount).toLocaleString()}`;
                            row.appendChild(amountCell);

                            const descriptionCell = document.createElement('td');
                            descriptionCell.classList.add('px-6', 'py-2');
                            descriptionCell.textContent = transaction.description;
                            row.appendChild(descriptionCell);

                            const dateCell = document.createElement('td');
                            dateCell.classList.add('px-6', 'py-2');
                            dateCell.textContent = transaction.date;
                            row.appendChild(dateCell);

                            transactionsTableBody.appendChild(row);
                        });
                    }

                    // Hide loading and show content
                    loadingTransactions.classList.add('hidden');
                    transactionsContent.classList.remove('hidden');
                })
                .catch(error => {
                    console.error("Error fetching transactions:", error);
                    alert("Failed to load transactions.");
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
