<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/custom.css', 'resources/js/custom.js'])
        <style>
            [x-cloak] { display: none; }
        </style>
        @paddleJS
    </head>
    <body class="font-sans antialiased">
        <div class="relative z-10 flex flex-row h-screen">
            @auth
                <livewire:layout.sidebar />
                @if (!Route::is('settings.checkout'))
                <livewire:layout.setting-sidebar />
                @endif
            @endauth

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
