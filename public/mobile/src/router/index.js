import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import blogpost from '@/components/blogpost'
import blogcategory from '@/components/blogcategory'
import events from '@/components/events'
import oaps from '@/components/oaps'
import single_oap from '@/components/single_oap'


Vue.use(Router)

export default new Router({

    routes: [{
            path: '/',
            name: 'Hello',
            component: Hello
        },
        {
            path: '/blogpost/:id/:title',
            component: blogpost,
            name: 'blogpost'
        },
        {
            path: '/blogcategory/:name/:id',
            component: blogcategory,
            name: 'blogcategory',
            props: true
        },
        {
            path: '/events',
            component: events,
            name: 'events'
        },
        {
            path: '/oaps',
            component: oaps,
            name: 'oaps'
        },
        {
            path: '/single_oap/:id/:name',
            component: single_oap,
            name: 'single_oap',
            props: true
        }
    ]
})