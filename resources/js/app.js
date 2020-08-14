/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
// import axios  from 'axios';
// Vue.use(axios);


import http   from './http';
import store  from './store';
import router from './router';

import * as VueGoogleMaps from "vue2-google-maps";
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyAsMyaK7aIpFYjTIbPBafSnxxOg3SwSIIk',
      libraries: ['places']
    }
});


// import {Client} from "@googlemaps/google-maps-services-js";

// // Vue.use(Client);

// const client = new Client({});

// client
// .elevation({
//     params: {
//         locations: [{ lat: 45, lng: -110 }],
//         key: "AIzaSyAsMyaK7aIpFYjTIbPBafSnxxOg3SwSIIk",
//         libraries: "places",
//     },
//     timeout: 1000, // milliseconds
// })
// .then((r) => {
//     console.log(r.data.results[0].elevation);
// })
// .catch((e) => {
//     console.log(e.response.data.error_message);
// });


// const googleMapsClient = require('@google/maps').createClient({
//     key: 'AIzaSyAsMyaK7aIpFYjTIbPBafSnxxOg3SwSIIk'
// });

// googleMapsClient.geocode({address: '1600 Amphitheatre Parkway, Mountain View, CA'})
// .asPromise()
// .then((response) => {
// console.log(response.json.results);
// })
// .catch((err) => {
// console.log(err);
// });

// const {Client, Status} = require("@googlemaps/google-maps-services-js");

// var axiosInstance = axios.create({
//     headers: {
//         'X-Requested-With': 'XMLHttpRequest',
//         'Access-Control-Allow-Origin' : "*",
//     },

// });
// const client = new Client({});


// // axios.defaults.headers.common['Access-Control-Allow-Origin'] = "*";
// client
// .elevation({
// params: {
//     locations: {lat: 45, lng: -110},
//     key: "AIzaSyAsMyaK7aIpFYjTIbPBafSnxxOg3SwSIIk"
// }, timeout: 1000 // milliseconds
// },axiosInstance)
// .then(r => {
//     console.log(r.data.results[0].elevation);
// })
// .catch(e => {
//     console.log("asddddddddddddd");
// console.log(e);
// })

Vue.component('index-component', require('./components/Index.vue').default);




const app = new Vue({
    el: '#app',
    http: http,
    store: store,
    router: router,

});
