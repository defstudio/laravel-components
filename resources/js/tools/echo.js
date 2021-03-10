/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

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
        forceTLS: false,
        encrypted: false
    };

    if (!allow_insecure || allow_insecure.content !== 'allow') {
        options.wssPort = 6001;
        options.forceTLS = true;
        options.encrypted = true;
    }

    window.Echo = new Echo(options);

}

