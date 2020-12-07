import moment from "moment";

window.Vue = require('vue');

const files = require.context('../../components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.filter('format_date', value => {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY HH:mm');
    }
})

const app = new Vue({
    el: '#app',
})
