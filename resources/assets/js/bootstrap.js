import axios from 'axios'
import Echo from 'laravel-echo'
import Pusher from 'pusher-js'
import Vue from 'vue'
import jQuery from 'jquery'

window.$ = window.jQuery = jQuery

require('bootstrap-sass');

window.Vue = Vue
window.axios = axios

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest'
};

window.Pusher = Pusher

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a0f4dd7614efad43920b',
    cluster: 'eu',
    encrypted: true
});
