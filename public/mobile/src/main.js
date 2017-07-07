// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'

window.moment = require('moment');
window.axios = require('axios');
window.lodash = require('lodash');
window.sharon = require('sharon');
window.tinymce = require('tinymce');

import vmodal from 'vue-js-modal'
Vue.use(vmodal)

Vue.component('clip-loader', require('vue-spinner/src/ClipLoader.vue'));

if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./service-worker.js').then(function(reg) {
        console.log('Successfully registered service worker', reg);
    }).catch(function(err) {
        console.warn('Error whilst registering service worker', err);
    });
}


var infiniteScroll = require('vue-infinite-scroll');
Vue.use(infiniteScroll)
window.accounting = require('accounting');
Vue.filter('money', function(value) {
    return accounting.format(value);
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store,
    template: '<App/>',
    components: { App }
})