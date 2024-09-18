<div>
    <span>{{ $count }}</span>
    <button wire:click="clicking">Click me</button>

</div>
{{-- @script

<script>
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

@endscript --}}
