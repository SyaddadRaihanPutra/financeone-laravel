<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="dicoding:email" content="putrasyaddad@gmail.com">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | FinanceOne</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.22.0/tabler-icons.css"
        integrity="sha512-pMUnRIOLdDaUxn5A+5iKAfTyUQ0bFZxc+OYOoGhSFvlvqmIsM3oqR1VDYxJdt0dmBHEb1BSV+oZ/MqEHuw0c0Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-white">
        <div class="relative px-6 isolate pt-14 lg:px-8">
            <!-- Background dengan z-index lebih rendah -->
            <div class="absolute inset-x-0 overflow-hidden -top-40 -z-20 transform-gpu blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative right-[calc(70%)] aspect-[1155/678] w-[36.125rem] translate-x-1/2 -rotate-[20deg] bg-gradient-to-l from-[#ff80b5] via-[#ff79f1] to-[#6a4ee3] opacity-65 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(
                74.1% 44.1%,
                100% 61.6%,
                97.5% 26.9%,
                85.5% 0.1%,
                80.7% 2%,
                72.5% 32.5%,
                60.2% 62.4%,
                52.4% 68.1%,
                47.5% 58.3%,
                45.2% 34.5%,
                27.5% 76.7%,
                0.1% 64.9%,
                17.9% 100%,
                27.6% 76.8%,
                76.1% 97.7%,
                74.1% 44.1%
              );">
                </div>
            </div>
            <x-navigation />
            @yield('content')
        </div>
        <x-footer />
    </div>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('script')
</body>

</html>
