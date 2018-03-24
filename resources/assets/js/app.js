/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
import VueLazyLoad from 'vue-lazyload'
//tell vue to use the router
Vue.use(VueRouter);
Vue.use(VueLazyLoad);

//window.sharon = require('sharon');

//vuex store
import store from './store'



Vue.component('clip-loader', require('vue-spinner/src/ClipLoader.vue'));

//Vue.component('adimage', require('./components/adimage.vue'));
Vue.filter('money', function(value) {
    return accounting.format(value);
})



import app from './components/app'
import events from './components/events'
import eventsInner from './components/eventsinner'
import errorpage from './components/errorpage'
import vendorregister from './components/vendorregister'



const routes = [
    //route for the home route of the webpage
    { path: '/', component: events, name: 'events' },
    { path: '/events/:name', component: eventsInner, name: 'events-inner', props: true },
    { path: '/vendor/register', component: vendorregister, name: 'vendor'},
    { path: '*', component: errorpage }
]



const router = new VueRouter({
    routes, // short for routes: routes
    store,
    mode: 'history'
})

router.beforeEach(function(to, from, next) {
    window.scrollTo(0, 0)
    next();
})


const coolfm = new Vue({
        //define the selector for the root component
        el: '#app',
        //pass the template to the root component
        template: '<app/>',
        //declare components that the root component can access
        components: { app },
        //pass in the router to the vue instance
        router,
        store
    }).$mount('#app') //mount the router on the app