require('./bootstrap');

import Vue from 'vue';
import store from './store/index';
import Main from './components/Main'

new Vue({
    el: '#app',
    store,
    components: {
        'mainpage': Main
    }
});