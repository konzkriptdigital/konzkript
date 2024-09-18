import Echo from 'laravel-echo';
import Pusher from 'pusher-js';


function authenticateBroadcast () {
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: process.env.MIX_REVERB_APP_KEY,
        wsHost: process.env.MIX_REVERB_HOST,
        wsPort: process.env.MIX_REVERB_PORT ?? 80,
        wssPort: process.env.MIX_REVERB_PORT ?? 443,
        forceTLS: (process.env.MIX_REVERB_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
    });

    window.Echo.channel('chat')
        .listen('ChatEvent', (e) => {
            console.log(e);
        })

}

authenticateBroadcast();


// Add listeners for connection events
window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('Connected to the broadcast server.');
});

window.Echo.connector.pusher.connection.bind('disconnected', () => {
    console.log('Disconnected from the broadcast server.');
});

window.Echo.connector.pusher.connection.bind('failed', () => {
    console.log('Failed to connect to the broadcast server.');
});
