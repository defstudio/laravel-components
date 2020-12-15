import Echo from "laravel-echo";

const echo_enabled = document.head.querySelector('meta[name="def-components-echo-enabled"]');
const allow_insecure = document.head.querySelector('meta[name="def-components-echo-allow-insecure"]');

if (echo_enabled && echo_enabled.content === 'enabled') {
    window.Pusher = require('pusher-js');

    const options = {
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        wsHost: window.location.hostname,
        wsPort: 6001,
    };

    if (!allow_insecure || allow_insecure.content !== 'allow') {
        options.wssPort = 6001;
        options.forceTLS = true;
    }

    window.Echo = new Echo(options);

}

