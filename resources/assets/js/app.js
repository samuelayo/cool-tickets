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
//tell vue to use the router
Vue.use(VueRouter);

window.sharon = require('sharon');

//vuex store
import store from './store'

// import VueAdsense from 'vue-adsense'
// Vue.component('adsense', VueAdsense)

var infiniteScroll = require('vue-infinite-scroll');
Vue.use(infiniteScroll)


Vue.component('clip-loader', require('vue-spinner/src/ClipLoader.vue'));

Vue.component('adimage', require('./components/adimage.vue'));
Vue.filter('money', function(value) {
    return accounting.format(value);
})

const VueGoogleMaps = require('vue2-google-maps');
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDIvfBrO5c7GYfRdPUFzquWOye2FOI6xg0',
        v: '3',
        libraries: 'places'
    }
})



import app from './components/app'
import landing from './components/landing'
import blogpost from './components/blogpost'
import oaps from './components/oaps'
import singleoaps from './components/singleoaps'
import all_podcasts from './components/allpodcast'
import chartcurrated from './components/chartcurrated'
import blogcategory from './components/blogcategory'
import events from './components/events'
import contact from './components/contact'
import errorpage from './components/errorpage'
import aboutus from './components/aboutus'



const routes = [
    //route for the home route of the webpage
    { path: '/', component: landing },
    { path: '/blogpost/:id/:title', component: blogpost, name: 'blogpost', props: true },
    { path: '/single_oap/:id/:name', component: singleoaps, name: 'single_oap' },
    { path: '/all_oaps', component: oaps, name: 'all_oaps' },
    { path: '/all_podcasts/:week', component: all_podcasts, name: 'all_podcasts', props: true },
    { path: '/chartcurrated/:currentchartweek', component: chartcurrated, name: 'chartcurrated', props: true },
    { path: '/blogcategory/:name/:id', component: blogcategory, name: 'blogcategory', props: true },
    { path: '/events', component: events, name: 'events' },
    { path: '/contact-us', component: contact, name: 'contact-us' },
    { path: '/aboutus', component: aboutus, name: 'aboutus' },
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