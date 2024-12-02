@extends('layouts.auth')

@section('title', 'Masuk Akun')
@section('content')
    <div class="max-w-md py-32 mx-auto sm:py-30 lg:py-30">
        <a href="{{ route('home') }}" class="flex items-center mb-3 text-slate-600">
            <i class="ti ti-arrow-left"></i> &nbsp;Kembali ke Beranda </a>
        <div class="p-5 bg-white shadow-2xl rounded-xl ring-2 ring-gray-300">
            <h1 class="text-2xl font-bold text-center">Masuk Akun</h1>
            <form action="{{ route('login.store') }}" method="POST" class="mt-5" id="loginForm">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700">Alamat Surel</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="syaddad@company.com"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="********"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required />
                        <div class="flex items-center justify-between mt-3">
                            <div>
                                <input type="checkbox" id="remember"
                                    class="mr-2 text-indigo-500 rounded-lg focus:ring-indigo-500" />
                                <label for="remember" class="text-sm font-medium text-gray-600">
                                    Ingat saya
                                </label>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ route('password.request') }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-700 focus:outline-none">Lupa
                                    kata sandi?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" id="submitButton"
                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="buttonText">Masuk</span>
                        <svg id="spinner" class="hidden w-5 h-5 ml-3 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="hidden ps-3" id="spinner-text">Tunggu sebentar...</span>
                    </button>
                </div>
            </form>
            <h1 class="mt-3 text-center">atau</h1>
            <div class="mt-4">
                <a type="button" href="{{ route('google.login') }}" id="googleLoginButton"
                    class="inline-flex items-center justify-center w-full py-2 text-sm font-medium text-gray-800 transition-all bg-white border border-transparent rounded-md shadow-sm ring-gray-500 ring-1 hover:bg-white-700 focus:outline-none hover:shadow-xl">
                    <span class="mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                            <path d="M1 1h22v22H1z" fill="none" />
                        </svg>
                    </span>
                    <span id="googleButtonText">Masuk dengan Google</span>
                    <svg id="googleSpinner" class="hidden w-5 h-5 ml-3 text-gray-800 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="hidden ps-3" id="googleSpinnerText">Tunggu sebentar...</span>
                </a>
            </div>
            <div class="mt-5 text-center">
                <p class="text-sm text-gray-600">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Daftar
                    sekarang</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const loginForm = document.getElementById('loginForm');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const spinner = document.getElementById('spinner');
        const spinnerText = document.getElementById('spinner-text');

        loginForm.addEventListener('submit', function() {
            submitButton.disabled = true; // Disable button
            buttonText.classList.add('hidden'); // Hide button text
            spinner.classList.remove('hidden'); // Show spinner
            spinnerText.classList.remove('hidden'); // Show spinner text
        });

        const googleLoginButton = document.getElementById('googleLoginButton');

        googleLoginButton.addEventListener('click', function() {
            submitButton.disabled = true; // Disable button
            buttonText.classList.add('hidden'); // Hide button text
            spinner.classList.remove('hidden'); // Show spinner
            spinnerText.classList.remove('hidden'); // Show spinner text
        });
    </script>
@endsection
