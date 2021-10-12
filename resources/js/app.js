require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import vue from 'vue'
window.Vue = vue;

import 'es6-promise/auto';
import App from './components/App.vue';
import VueRouter from 'vue-router';

import VueAxios from 'vue-axios';
import axios from 'axios';
require('promise.prototype.finally').shim();

import {routes} from './routes';
 
import store from './store';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faBars } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import "@fontsource/mrs-saint-delafield"



library.add(faUserSecret)
library.add(faBars)

Vue.component('font-awesome-icon', FontAwesomeIcon)


Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

Vue.use(VueRouter);
Vue.use(VueAxios, axios);


const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    el: '#app',
    store: store,
    router: router,
    render: h => h(App),
});