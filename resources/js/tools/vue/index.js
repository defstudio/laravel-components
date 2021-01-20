/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

import moment from "moment";
import Vue from "vue";

if ($('#app').length > 0) {
    const files = require.context('../../components', true, /\.vue$/i);
    files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

    Vue.filter('format_date', value => {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY HH:mm');
        }
    })
}

