import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import blogpost from '@/components/blogpost'
import blogcategory from '@/components/blogcategory'


Vue.use(Router)

export default new Router({

  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
      path:'/blogpost/:id/:title', 
      component: blogpost, 
      name: 'blogpost'
    },
    {
      path:'/blogcategory/:name/:id', 
      component: blogcategory, 
      name: 'blogcategory', 
      props: true
    }
  ]
})
