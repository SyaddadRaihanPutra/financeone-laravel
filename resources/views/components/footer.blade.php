@if (request()->routeIs(['dashboard', 'transactions.*', 'profile.*']))
    <nav class="fixed inset-x-0 bottom-0 z-50 px-4 m-5 rounded-full shadow-2xl bg-white/80 backdrop-blur-lg lg:hidden">
        <div class="relative flex items-center justify-between p-4">
            <!-- Group 1: Home and Search -->
            <div class="flex items-center space-x-16">
                <a href="{{ route('dashboard') }}"
                    class="flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-indigo-500' : 'text-gray-400' }}">
                    <i class="text-2xl ti ti-home"></i>
                </a>
                <a href="#"
                    class="flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-indigo-500' : 'text-gray-400' }}">
                    <i class="text-2xl ti ti-cash-register"></i>
                </a>
            </div>

            <!-- Floating Action Button (Plus) -->
            <a href="{{ route('transactions.create') }}"
                class="absolute flex items-center justify-center w-16 h-16 text-white transition-all duration-300 transform -translate-x-1/2 bg-indigo-500 border-4 border-white rounded-full shadow-lg -top-6 left-1/2 hover:bg-indigo-600"
                style="margin-top: 0px;">
                <i class="text-3xl ti ti-copy-plus"></i>
            </a>

            <!-- Group 2: Message and Profile -->
            <div class="flex items-center space-x-16">
                <a href="{{ route('transactions.index') }}"
                    class="flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-500 hover:scale-110 {{ request()->routeIs('transactions.index') ? 'text-indigo-500' : 'text-gray-400' }}">
                    <i class="text-2xl ti ti-history"></i>
                </a>
                <a href="{{ route('profile.show') }}"
                    class="relative flex flex-col items-center justify-center text-sm font-medium transition-all duration-300 transform hover:text-indigo-600 hover:scale-110 {{ request()->routeIs('profile.show') ? 'text-indigo-500' : 'text-gray-400' }}">
                    <i class="text-2xl ti ti-user"></i>
                    @if (request()->routeIs('profile'))
                        <span class="absolute bottom-0 w-1 h-1 bg-indigo-500 rounded-full"></span>
                    @endif
                </a>
            </div>
        </div>
    </nav>
@endif

@if (!request()->routeIs(['dashboard', 'transactions.*']))
    <footer class="py-10 text-white">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="pt-6 mt-10 text-sm text-center border-t border-slate-300 text-slate-400">
                &copy; 2024 FinanceOne. Dibuat dengan <i class="text-red-500 ti ti-heart"></i>
                <p><a href="https://syaddad.pages.dev" class="font-semibold text-indigo-600">syaddad.dev</a></p>
            </div>
        </div>
    </footer>
@endif
