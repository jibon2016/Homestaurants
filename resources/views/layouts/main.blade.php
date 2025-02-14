<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('images/favicon-48.ico') }}" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script>

            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/os_dark_light.js'])
        @livewireStyles
    </head>
    <body class="dark:bg-gray-950">


    <nav class="bg-white shadow-md dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-950">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <x-flowbite-logo />
        <div class="flex md:order-2">
            <x-cart-icon class="relative">
                <span class="absolute top-2 @if ($cartNumbers < 1 ) hidden @endif bg-yellow-400 rounded-full text-white text-xs p-1">
                  @if ($cartNumbers > 0)
                      {{$cartNumbers}}
                  @else
                      {{__(0)}}
                  @endif
                </span>
            </x-cart-icon>
            <x-light-dark-toggle class="ml-1 mr-0" />
            {{-- <button type="button" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-green-400 dark:hover:bg-green-500 dark:focus:ring-green-600">Get started</button> --}}
            <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-1 text-sm text-gray-500 rounded-lg md:hidden focus:ring-0 dark:text-gray-400" aria-controls="navbar-sticky" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 text-lg font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-900 md:dark:bg-gray-900 dark:border-gray-200">
            {{-- <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-white bg-green-500 rounded md:bg-transparent md:text-green-500 md:p-0 md:dark:text-green-300" aria-current="page">Home</a>
            </li> --}}
            @if (Route::has('login'))

                    @auth
                        <x-dropdown-flowbite-link class="dark:text-gray-200" href="{{ url('/customer-orders') }}">Recent Orders</x-dropdown-flowbite-link>
                    @else
                        <x-dropdown-flowbite-link class="dark:text-gray-200" href="{{ route('login') }}">Log in</x-dropdown-flowbite-link>

                        @if (Route::has('register'))
                            <x-dropdown-flowbite-link class="dark:text-gray-200" href="{{ route('register') }}">Register</x-dropdown-flowbite-link>
                        @endif
                    @endauth

            @endif

        </ul>
        </div>
        </div>
    </nav>


    <main>
        {{ $slot }}
    </main>

    <x-flowbite-footer />

    @livewireScripts
    </body>
</html>
