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

        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ mix('js/custom.js') }}"></script>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>

    {{-- @livewireScripts --}}
    {{-- <script src="{{ mix('js/ghl.js') }}"></script> --}}
{{-- <script>
    console.log('test')
    // Send a message to the parent window when the iframe loads
    // window.parent.postMessage('sending message from iframe', "*");

    // Listen for messages from the parent window
    window.addEventListener('message', (event) => {
        console.log('Message received in iframe:', event.data);
        const userId = event.data;

        if (userId) {
            console.log('Message received in iframe with user ID:', userId);

            // Trigger Livewire method to authenticate the user
            // @this.call('authenticateIframeUser', userId);
            $wire.authenticateIframeUser(userId);
            $wire.checkAuth();
        }
    });
</script>
 --}}

</html>
