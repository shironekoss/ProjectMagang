/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

import "bootstrap/dist/css/bootstrap.css"
import 'vuetify/dist/vuetify.min.css'
import Vue from 'vue';
import { createPinia, PiniaVuePlugin } from 'pinia';
import VueSweetalert2 from 'vue-sweetalert2';
import Vuetify from '../plugins/vuetify';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import router from '../../resources/js/router/route';
import axios from 'axios';
// import { fakeBackend } from '../Stores/helpers/fake-backend';
// fakeBackend();
// If you don't need the styles, do not connect
// import 'sweetalert2/dist/sweetalert2.min.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
axios.defaults.withCredentials=true;
axios.defaults.baseURL = 'http://localhost:8000/'

Vue.component('header-component', require('./components/General/HeaderComponent.vue').default);
Vue.component('footer-component', require('./components/General/FooterComponent.vue').default);

// untuk latihan
Vue.component('latihanbutton', require('./components/Pages/InputNoSPK/SpkInputtrigger.vue').default);


Vue.use(PiniaVuePlugin);
const pinia = createPinia();
pinia.use(piniaPluginPersistedstate);
Vue.use(VueSweetalert2);
// const NotFound =require('./components/HandlingError/NotFound.vue').default

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify:Vuetify,
    el: '#app',
    // data: {
    //     title: 'Rancangan Program SPK'
    // },
    pinia,
    router,
});


