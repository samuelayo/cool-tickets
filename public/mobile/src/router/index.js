import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import blogpost from '@/components/blogpost'
import blogcategory from '@/components/blogcategory'
import forum from '@/components/forum'
import single_forum from '@/components/single_forum'
import events from '@/components/events'


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
            path: '/forums',
            component: forum,
            name: 'forum'
        },
        {
            path: '/forum/:id/:name',
            component: single_forum,
            name: 'single_forum',
            props: true
        },
        {
            path: '/events',
            component: events,
            name: 'events'
        }
    ]
})