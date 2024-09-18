<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/custom.css', 'resources/js/custom.js']) --}}
    {{-- <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- Correct path used here -->
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    {{-- @dd(asset('resources/js/app.js')) --}}
    {{-- <script src="{{ asset('resources/js/app.js') }}"></script> --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/custom.js') }}"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @paddleJS
</head>

<body
    class="font-sans antialiased flex h-full text-base text-gray-700  [--tw-content-bg:var(--tw-light)] [--tw-content-bg-dark:var(--tw-coal-500)] [--tw-sidebar_primary-width:54px] [--tw-header-height:60px] [--tw-sidebar-width:290px] bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
    {{-- <canvas id="gradient-canvas" data-transition-in></canvas> --}}
    <div class="flex flex-col grow">
        <x-partials.header />
        <div class="flex grow flex-col pt-[--tw-header-height] lg:pt-0 overflow-x-hidden overflow-y-auto">
            @auth
                <x-partials.sidebar />
            @endauth
            <!-- Page Content -->
            <main role="content" class="flex flex-col
                {{-- lg:ms-[--tw-sidebar-width] --}}
                @if (Route::is('dashboard') || Route::is('settings.checkout') || Route::is('settings.pricing'))
                    lg:ms-[--tw-sidebar_primary-width]
                @else
                    lg:ms-[--tw-sidebar-width]
                @endif
                mt-0 h-full">
                {{-- class="flex flex-col grow z-10 isolate aspect-video rounded-xl bg-white/60 shadow-lg ring-1 ring-black/5 border border-gray-300 dark:border-gray-200 lg:ms-[--tw-sidebar-width] pt-5 mt-0 lg:mt-5 m-5"> --}}
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
