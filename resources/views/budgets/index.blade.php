@extends('layouts.custom-layout')
@section('title', 'Buat Anggaran')
@section('content')
    <div class="container pt-12 mx-auto">
        <div class="p-5 mt-5 transition-all bg-white shadow-lg rounded-xl hover:shadow-xl">
            <h1 class="text-2xl font-bold text-center">Buat Anggaran</h1>
            <form action="{{ route('budgets.store') }}" method="POST">
                @csrf
                <div class="space-y-6 mt-4">
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah</label>
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
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                        <div class="relative group">
                            <button type="button" id="dropdown-button-unique" class="inline-flex justify-between w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                <span class="mr-2">Pilih Tipe</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="dropdown-menu-unique" class="hidden absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 p-1 space-y-1 w-full">
                                <input id="search-input-unique" class="block w-full px-4 py-2 text-gray-800 border rounded-md border-gray-300 focus:outline-none" type="text" placeholder="Cari tipe" autocomplete="off">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="food"><i class="ti ti-tools-kitchen-3"></i> Makanan</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="transport"><i class="ti ti-bike"></i> Transportasi</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="health"><i class="ti ti-stethoscope"></i> Kesehatan</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="education"><i class="ti ti-school"></i> Pendidikan</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="entertainment"><i class="ti ti-device-gamepad-2"></i> Hiburan</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="house"><i class="ti ti-home-eco"></i> Rumah Tangga</a>
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-indigo-100 cursor-pointer rounded-md" data-value="others"><i class="ti ti-dots"></i> Lainnya</a>
                            </div>
                        </div>
                        <script>
                            const dropdownButtonUnique = document.getElementById('dropdown-button-unique');
                            const dropdownMenuUnique = document.getElementById('dropdown-menu-unique');
                            const searchInputUnique = document.getElementById('search-input-unique');
                            const dropdownItemsUnique = dropdownMenuUnique.querySelectorAll('a');
                            let isOpenUnique = false;

                            function toggleDropdownUnique() {
                                isOpenUnique = !isOpenUnique;
                                dropdownMenuUnique.classList.toggle('hidden', !isOpenUnique);
                            }

                            dropdownButtonUnique.addEventListener('click', (e) => {
                                e.stopPropagation();
                                toggleDropdownUnique();
                            });

                            searchInputUnique.addEventListener('input', () => {
                                const searchTerm = searchInputUnique.value.toLowerCase();
                                dropdownItemsUnique.forEach((item) => {
                                    const text = item.textContent.toLowerCase();
                                    item.style.display = text.includes(searchTerm) ? 'block' : 'none';
                                });
                            });

                            dropdownItemsUnique.forEach((item) => {
                                item.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    const value = item.getAttribute('data-value');
                                    const icon = item.querySelector('i').outerHTML;
                                    dropdownButtonUnique.querySelector('span').innerHTML = icon + ' ' + item.textContent;
                                    document.getElementById('type').value = value;
                                    dropdownItemsUnique.forEach((el) => el.classList.remove('bg-indigo-100'));
                                    item.classList.add('bg-indigo-100');
                                    toggleDropdownUnique();
                                });
                            });

                            document.addEventListener('click', (e) => {
                                if (!dropdownMenuUnique.contains(e.target) && !dropdownButtonUnique.contains(e.target)) {
                                    if (isOpenUnique) {
                                        toggleDropdownUnique();
                                    }
                                }
                            });
                        </script>
                        <input type="hidden" name="type" id="type" required>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="description" id="description" placeholder="Cth: Token listrik bulan ini"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                            required></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="start_date" id="start_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                required>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai dengan</label>
                            <input type="date" name="end_date" id="end_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none sm:text-sm"
                                required>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-500 rounded-md hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Buat Anggaran</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="mt-5 rounded-xl shadow-lg p-5">
            <h2 class="text-lg font-semibold">Anggaran anda</h2>
            <div class="grid grid-cols-1 gap-4 mt-4">
            @foreach($budgets as $budget)
                <div class="p-4 bg-white rounded-md shadow-md">
                <h3 class="text-md font-bold">{{ $budget->type }}</h3>
                <p class="text-sm text-gray-600">Jumlah: Rp{{ number_format($budget->amount, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-600">Keterangan: {{ $budget->description }}</p>
                <p class="text-sm text-gray-600">Tanggal: {{ $budget->date }}</p>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection
