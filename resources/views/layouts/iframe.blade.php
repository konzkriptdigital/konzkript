<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        {{-- <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- Correct path used here -->
        <link rel="stylesheet" href="{{ mix('css/custom.css') }}">

        <script src="{{ mix('js/custom.js') }}"></script>

        <style>
            [x-cloak]{
                display: none;
            }

        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen sm:justify-center">
            {{ $slot }}
        </div>
    </body>

    <script src="{{ mix('js/iframes/iframe.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
</html>
