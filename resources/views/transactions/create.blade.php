@extends('layouts.custom-layout')
@section('title', 'Tambah Transaksi')
@section('content')
    <div class="container pt-12 mx-auto">
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <h1 class="text-2xl font-bold text-center">Tambah Transaksi</h1>
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="space-y-6 mt-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Transaksi</label>
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="text" name="amount" id="amount" placeholder="10.000"
                                class="block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm appearance-none"
                                required oninput="formatCurrency(this)" onblur="removeFormat(this)">
                            <style>
                                input::-webkit-outer-spin-button,
                                input::-webkit-inner-spin-button {
                                    -webkit-appearance: none;
                                    margin: 0;
                                }

                                /* Firefox */
                                input[type=number] {
                                    -moz-appearance: textfield;
                                }
                            </style>
                            <script>
                                function formatCurrency(input) {
                                    let value = input.value.replace(/[^,\d]/g, '').toString();
                                    let split = value.split(',');
                                    let sisa = split[0].length % 3;
                                    let rupiah = split[0].substr(0, sisa);
                                    let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                    if (ribuan) {
                                        let separator = sisa ? '.' : '';
                                        rupiah += separator + ribuan.join('.');
                                    }

                                    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                                    input.value = rupiah;
                                }

                                function removeFormat(input) {
                                    input.value = input.value.replace(/\./g, '');
                                }
                            </script>
                        </div>
                    </div>
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Tipe</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="type" value="income" class="hidden" required>
                                <span
                                    class="px-4 py-2 text-sm rounded-md border-2 flex items-center gap-1 font-semibold border-green-500 cursor-pointer transition-all duration-300"
                                    onclick="this.previousElementSibling.checked = true; updateRadioStyles()"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                        <path d="M3 10h18" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16l3 3l-3 3" />
                                        <path d="M7.005 15h.005" />
                                        <path d="M11 15h2" />
                                    </svg>Pemasukan</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="type" value="expense" class="hidden" required>
                                <span
                                    class="px-4 py-2 text-sm rounded-md border-2 flex items-center gap-1 font-semibold border-red-500 cursor-pointer transition-all duration-300"
                                    onclick="this.previousElementSibling.checked = true; updateRadioStyles()"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-refund">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                        <path d="M3 10h18" />
                                        <path d="M7 15h.01" />
                                        <path d="M11 15h2" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16l-3 3l3 3" />
                                    </svg>Pengeluaran</span>
                            </label>
                        </div>
                    </div>

                    <script>
                        function updateRadioStyles() {
                            document.querySelectorAll('input[name="type"]').forEach((radio) => {
                                const span = radio.nextElementSibling;
                                if (radio.checked) {
                                    // Checked style
                                    span.classList.add('text-white');
                                    span.classList.remove('bg-transparent', 'text-green-500', 'text-red-500');
                                    if (radio.value === "income") {
                                        span.classList.add('bg-green-500');
                                    } else if (radio.value === "expense") {
                                        span.classList.add('bg-red-500');
                                    }
                                } else {
                                    // Unchecked style
                                    span.classList.remove('bg-green-500', 'bg-red-500', 'text-white');
                                    span.classList.add('bg-transparent');
                                    if (radio.value === "income") {
                                        span.classList.add('text-green-500');
                                    } else if (radio.value === "expense") {
                                        span.classList.add('text-red-500');
                                    }
                                }
                            });
                        }
                        document.addEventListener('DOMContentLoaded', updateRadioStyles);
                    </script>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="description" id="description" placeholder="Ex: Makan siang"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                            required></textarea>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                        <input type="date" name="date" id="date"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                            required>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-md hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Buat Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
