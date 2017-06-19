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