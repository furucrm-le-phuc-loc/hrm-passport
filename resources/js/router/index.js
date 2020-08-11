import Vue from 'vue'
import Router from 'vue-router'
import store  from '../store'

Vue.use(Router)

import Index from '../components/Index.vue'
import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'





const router =  new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            component: Index,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/login',
            component: Login,
            meta: {
                // requiresAuth: true,
                checkLogin: true,
            }
        },
        {
            path: '/register',
            component: Register,
            meta: {
                checkLogin: true
            }
        },

    ]
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!localStorage.getItem('token')) {
            next("/login")
        }
        else {
            next()
        }
    }
    else if (to.matched.some(record => record.meta.checkLogin)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (localStorage.getItem('token')) {
            next("/")
        }
        else {
            next()
        }
    }
    else {
        next() // make sure to always call next()!
    }



})


export default router;
