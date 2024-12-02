@if (request()->routeIs(['dashboard', 'transactions.*', 'budgets.*', 'profile.*']))
    <nav class="fixed inset-x-0 bottom-0 z-50 px-4 m-5 rounded-full shadow-2xl bg-white/80 backdrop-blur-lg lg:hidden">
        <div class="relative flex items-center justify-between p-4">
            <!-- Group 1: Home and Search -->
            <div class="flex items-center space-x-16">
                <div class="relative group">
                    <a href="{{ route('dashboard') }}"
                        class="relative flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-indigo-500' : 'text-gray-400' }}">
                        <i class="text-2xl ti ti-home"></i>
                        @if (request()->routeIs('dashboard'))
                            <span class="absolute bottom-0 w-1 h-1 bg-indigo-500 rounded-full"></span>
                        @endif
                    </a>
                    <div
                        class="absolute left-1/2 bottom-12 -translate-x-1/2 flex items-center px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Dashboard
                        <div
                            class="absolute w-3 h-3 -bottom-1.5 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-900">
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <a href="{{ route('budgets.index') }}"
                        class="relative flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('budgets.index') ? 'text-indigo-500' : 'text-gray-400' }}">
                        <i class="text-2xl ti ti-cash-register"></i>
                        @if (request()->routeIs('budgets.index'))
                            <span class="absolute bottom-0 w-1 h-1 bg-indigo-500 rounded-full"></span>
                        @endif
                    </a>
                    <div
                        class="absolute left-1/2 bottom-12 -translate-x-1/2 flex items-center px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Anggaran
                        <div
                            class="absolute w-3 h-3 -bottom-1.5 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-900">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button -->
            <a href="{{ route('transactions.create') }}"
                class="absolute flex items-center justify-center w-16 h-16 text-white transition-all duration-300 transform -translate-x-1/2 bg-indigo-500 border-4 border-white rounded-full shadow-lg -top-6 left-1/2 hover:bg-indigo-600">
                <i class="text-3xl ti ti-copy-plus"></i>
            </a>

            <!-- Group 2: History and Profile -->
            <div class="flex items-center space-x-16">
                <div class="relative group">
                    <a href="{{ route('transactions.index') }}"
                        class="relative flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('transactions.index') ? 'text-indigo-500' : 'text-gray-400' }}">
                        <i class="text-2xl ti ti-history"></i>
                        @if (request()->routeIs('transactions.index'))
                            <span class="absolute bottom-0 w-1 h-1 bg-indigo-500 rounded-full"></span>
                        @endif
                    </a>
                    <div
                        class="absolute left-1/2 bottom-12 -translate-x-1/2 flex items-center px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Riwayat
                        <div
                            class="absolute w-3 h-3 -bottom-1.5 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-900">
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <a href="{{ route('profile.show') }}"
                        class="relative flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-600 hover:scale-110 {{ request()->routeIs('profile.show') ? 'text-indigo-500' : 'text-gray-400' }}">
                        <i class="text-2xl ti ti-user"></i>
                        @if (request()->routeIs('profile.show'))
                            <span class="absolute bottom-0 w-1 h-1 bg-indigo-500 rounded-full"></span>
                        @endif
                    </a>
                    <div
                        class="absolute left-1/2 bottom-12 -translate-x-1/2 flex items-center px-2 py-1 text-xs font-medium text-white bg-gray-900 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Profil
                        <div
                            class="absolute w-3 h-3 -bottom-1.5 left-1/2 transform -translate-x-1/2 rotate-45 bg-gray-900">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

@endif

@if (!request()->routeIs(['dashboard', 'transactions.*', 'budgets.*', 'profile.*']))
    <footer class="py-10 text-white">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="pt-6 mt-10 text-sm text-center border-t border-slate-300 text-slate-400">
                &copy; 2024 FinanceOne. Dibuat dengan <i class="text-red-500 ti ti-heart"></i>
                <p><a href="https://syaddad.pages.dev" class="font-semibold text-indigo-600">syaddad.dev</a></p>
            </div>
        </div>
    </footer>
@endif

<div id="confirmation-modal"
    class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-500 bg-gray-500 bg-opacity-50 opacity-0">
    <!-- Modal content -->
    <div
        class="mx-8 overflow-hidden transition-transform duration-500 transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div
                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="w-6 h-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm leading-5 text-gray-500">
                            Apakah Anda yakin ingin keluar? Anda harus masuk kembali untuk mengakses akun Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
            <!-- Submit Form (Logout) -->
            <span class="flex w-full gap-3 rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="w-full">
                    @csrf
                    <button type="submit"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red sm:text-sm sm:leading-5">
                        Keluar
                    </button>
                </form><button id="cancel-btn" type="button"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline sm:text-sm sm:leading-5">
                    Batal
                </button>
            </span>
        </div>
    </div>
</div>
