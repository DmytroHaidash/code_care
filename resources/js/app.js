require('./bootstrap');

import Vue from 'vue';

Vue.component('example', require('./components/Example.vue'));

new Vue({
    el: '#app'
});
