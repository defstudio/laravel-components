import Echo from "laravel-echo";

const echo_enabled = document.head.querySelector('meta[name="def-components-echo-enabled"]');

if (echo_enabled && echo_enabled.content) {
    window.Pusher = require('pusher-js');

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        forceTLS: true,
        wsHost: window.location.hostname,
        wsPort: 6001,
        wssPort: 6001,
    });

}

