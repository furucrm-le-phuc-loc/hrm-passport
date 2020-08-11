import Vue from 'vue'

import auth            from '@websanova/vue-auth/src/index.js';
import authBearer      from '@websanova/vue-auth/drivers/auth/bearer.js';
import httpAxios       from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import routerVueRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x.js';


Vue.use(auth, {
    auth: authBearer,
    http: httpAxios, // Axios
    // http: httpVueResource, // Vue Resource
    router: routerVueRouter,
    rolesKey: 'type',
    notFoundRedirect: {name: 'user-account'},
    
});