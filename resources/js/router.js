import Vue from 'vue'
import Router from 'vue-router'

import Index from './components/Index.vue'
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'



Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            component: Index
        },
        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            component: Register
        },

    ]
})
