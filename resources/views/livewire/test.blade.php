<div>
    {{ auth()->user()->subscriptions }}
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <x-paddle-button :checkout="$checkout" class="px-8 py-4">
        Subscribe
    </x-paddle-button>
    @paddleJS
</div>
