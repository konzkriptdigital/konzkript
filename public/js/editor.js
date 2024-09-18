/*!********************************!*\
  !*** ./resources/js/editor.js ***!
  \********************************/
document.addEventListener('livewire:initialized', function () {
  // Runs immediately after Livewire has finished initializing
  var origin = "*";
  window.addEventListener('message', function (event) {
    // console.log('Message received in iframe:', event.data);

    if (event.data.hasOwnProperty('ghl')) {
      if (event.data.ghl.hasOwnProperty('user') && event.data.ghl.hasOwnProperty('users')) {
        Livewire.dispatchTo('pages.editor', 'authorizeUserFromGhl', {
          data: event.data
        });
      }
    }
  });
  Livewire.on('reAuthenticateBroadcast', function () {
    // console.log('called reAuthenticateBroadcast');
    window.Echo.disconnect();
    window.Echo.connect();
    window.Echo.connector.pusher.connection.bind('connected', function () {
      // console.log('Reauthenticated successfully!');
      // You can also trigger some other actions here if needed
    });
    window.Echo.connector.pusher.connection.bind('disconnected', function () {
      // console.log('Disconnected from Echo!');
    });
  });
  Livewire.on('getUserId', function (user) {
    // console.log('user =>>> ', user)
    window.parent.postMessage(user, origin);
  });
  Livewire.on('user-status', function (action) {
    // console.log('user-status action', action)
    window.parent.postMessage(action, origin);
  });
});
