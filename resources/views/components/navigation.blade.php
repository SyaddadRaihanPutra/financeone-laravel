<header class="fixed inset-x-0 top-0 z-50 m-8">
    @if (request()->route('dashboard'))
        <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5 flex">
                    <img src="{{ asset('img/financeone-logo.png') }}" alt="FinanceOne" class="w-8 h-8" />
                    <h1 class="text-2xl font-bold ms-3">Finance One</h1>
                </a>
            </div>
            <div class="relative flex lg:hidden">
                <!-- Profile Image and Arrow -->
                <div class="flex items-center cursor-pointer" id="profile-btn">
                    @auth
                        <img id="profile-image"
                            src="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : Auth::user()->profile_photo_url }}"
                            alt="Profile Image" class="w-8 h-8 rounded-full" />
                        <i class="ml-1 transition-transform duration-200 ti ti-chevron-down" id="arrow-icon"></i>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-semibold leading-6 text-gray-900 transition-all hover:bg-white hover:text-indigo-600 hover:ring-indigo-600 hover:ring-2 hover:px-3 hover:py-1 hover:rounded-lg">
                            Masuk
                            <i class="ti ti-arrow-right"></i>
                        </a>
                    @endauth
                </div>

                <!-- Dropdown Menu -->
                <div id="dropdown-menu"
                    class="absolute right-0 z-10 hidden w-40 mt-8 origin-top-right bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
                    <div class="py-1">
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Profil
                        </a>
                    </div>
                    <div class="py-1">
                        <!-- Logout Button (Trigger Modal) -->
                        <button id="logout-btn"
                            class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                            Keluar
                        </button>
                    </div>
                </div>

                <!-- Modal Confirmation -->
                <div id="confirmation-modal"
                    class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-500 bg-gray-500 bg-opacity-50 opacity-0">
                    <!-- Modal content -->
                    <div
                        class="mx-8 overflow-hidden transition-transform duration-500 transform bg-white rounded-lg shadow-xl sm:max-w-lg sm:w-full">
                        <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="w-6 h-6 text-red-600" stroke="currentColor" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Konfirmasi Logout
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm leading-5 text-gray-500">
                                            Apakah Anda yakin ingin keluar? Semua data Anda akan hilang dan Anda tidak
                                            dapat
                                            mengembalikannya lagi.
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
            </div>

            <script>
                // Dropdown menu toggle
                const profileBtn = document.getElementById('profile-btn');
                const dropdownMenu = document.getElementById('dropdown-menu');

                profileBtn.addEventListener('click', () => {
                    // Toggle dropdown visibility
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown if clicked outside
                document.addEventListener('click', (event) => {
                    if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });

                // Modal elements
                const logoutBtn = document.getElementById('logout-btn');
                const confirmationModal = document.getElementById('confirmation-modal');
                const cancelBtn = document.getElementById('cancel-btn');

                // Show the modal with animation
                logoutBtn.addEventListener('click', () => {
                    confirmationModal.classList.remove('hidden');
                    setTimeout(() => {
                        confirmationModal.classList.remove('opacity-0');
                        confirmationModal.classList.add('opacity-100');
                    }, 10); // short delay before animation starts
                });

                // Hide the modal with animation
                cancelBtn.addEventListener('click', () => {
                    confirmationModal.classList.remove('opacity-100');
                    confirmationModal.classList.add('opacity-0');
                    setTimeout(() => {
                        confirmationModal.classList.add('hidden');
                    }, 500); // after animation ends, hide modal
                });

                // Close modal if clicked outside
                document.addEventListener('click', (event) => {
                    if (!confirmationModal.contains(event.target) && !logoutBtn.contains(event.target)) {
                        confirmationModal.classList.remove('opacity-100');
                        confirmationModal.classList.add('opacity-0');
                        setTimeout(() => {
                            confirmationModal.classList.add('hidden');
                        }, 500); // after animation ends, hide modal
                    }
                });
            </script>

            <style>
                /* Modal Transition */
                #confirmation-modal {
                    transition: opacity 0.5s ease-in-out;
                }

                .transform {
                    transition: transform 0.5s ease-in-out;
                }
            </style>

            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            class="px-3 py-1 text-sm font-semibold leading-6 text-red-600 transition-all bg-red-100 rounded-lg ring-red-600 ring-2">
                            Keluar
                            <i class="ti ti-logout"></i></button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold leading-6 text-gray-900 transition-all hover:bg-white hover:text-indigo-600 hover:ring-indigo-600 hover:ring-2 hover:px-3 hover:py-1 hover:rounded-lg">
                        Masuk
                        <i class="ti ti-arrow-right"></i>
                    </a>
                @endauth
            </div>
        </nav>

        <!-- Bottom Navigation -->
        <nav
            class="fixed inset-x-0 bottom-0 z-50 px-4 m-5 rounded-full shadow-2xl bg-white/80 backdrop-blur-lg lg:hidden">
            <div class="relative flex items-center justify-between p-4">
                <!-- Home Link -->
                <a href="#"
                    class="flex flex-col items-center justify-center text-sm font-medium text-gray-400 transition-all duration-300 transform hover:text-orange-500 hover:scale-110">
                    <i class="text-2xl ti ti-home"></i>
                </a>
                <!-- Search Link -->
                <a href="#"
                    class="flex flex-col items-center justify-center text-sm font-medium text-gray-400 transition-all duration-300 transform hover:text-orange-500 hover:scale-110">
                    <i class="text-2xl ti ti-search"></i>
                </a>
                <!-- Floating Action Button -->
                <a href="#"
                    class="absolute flex items-center justify-center w-16 h-16 text-white transition-all duration-300 transform -translate-x-1/2 bg-orange-500 border-4 border-white rounded-full shadow-lg -top-6 left-1/2 hover:bg-orange-600"
                    style="margin-top: 10px;">
                    <i class="text-3xl ti ti-plus"></i>
                </a>
                <!-- Chat Link -->
                <a href="#"
                    class="flex flex-col items-center justify-center text-sm font-medium text-gray-400 transition-all duration-300 transform hover:text-orange-500 hover:scale-110">
                    <i class="text-2xl ti ti-message-circle"></i>
                </a>
                <!-- Profile Link -->
                <a href="#"
                    class="relative flex flex-col items-center justify-center text-sm font-medium text-orange-500 transition-all duration-300 transform hover:text-orange-600 hover:scale-110">
                    <i class="text-2xl ti ti-user"></i>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-orange-500 rounded-full"></span>
                </a>
            </div>
        </nav>
    @endif

    {{-- NAVIGASI DI LANDING PAGE --}}
    <nav class="flex items-center justify-between p-4 bg-white shadow-lg lg:px-8 rounded-2xl" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5 flex">
                <img src="{{ asset('img/financeone-logo.png') }}" alt="FinanceOne" class="w-8 h-8" />
                <h1 class="text-2xl font-bold ms-3">Finance One</h1>
            </a>
        </div>
        <div class="lg:hidden">
            <button id="open-menu" type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open menu</span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                    fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile menu dialog -->
    <div id="mobile-menu" class="fixed inset-0 hidden bg-black lg:hidden bg-opacity-30">
        <div class="fixed inset-y-0 right-0 z-50 w-3/4 px-6 py-6 overflow-y-auto bg-white shadow-2xl">
            <div class="flex items-center justify-between">
                <a href="/" class="-m-1.5 p-1.5">
                    <h1 class="text-2xl font-bold">Finance One</h1>
                </a>
                <button id="close-menu" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-6">
                <div class="space-y-2">
                    <a href="#"
                        class="block px-3 py-2 text-base font-semibold leading-7 text-gray-900 rounded-lg hover:bg-gray-50">Fitur</a>
                    <a href="/tentang"
                        class="block px-3 py-2 text-base font-semibold leading-7 text-gray-900 rounded-lg hover:bg-gray-50">Tentang</a>
                    <a href="#"
                        class="block px-3 py-2 text-base font-semibold leading-7 text-gray-900 rounded-lg hover:bg-gray-50">Blog</a>
                </div>
                <div class="py-6">
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-semibold leading-7 text-gray-900 rounded-lg hover:bg-gray-50">Masuk</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const openMenuBtn = document.getElementById('open-menu');
        const closeMenuBtn = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        openMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
        });

        closeMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });

        // Close mobile menu if clicked outside
        document.addEventListener('click', (event) => {
            if (!mobileMenu.contains(event.target) && !openMenuBtn.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</header>
