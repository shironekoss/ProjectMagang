/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

import "../assets/css/styling.css";
import "bootstrap/dist/css/bootstrap.css"
import 'vuetify/dist/vuetify.min.css'
import Vue from 'vue'
import pinia from'../Stores/Pinia'
import VueSweetalert2 from 'vue-sweetalert2';
import Vuetify from '../plugins/vuetify';

import axios from 'axios';
import VueHtmlToPaper from 'vue-html-to-paper';
// import store from '../Stores/Store';
import router from '../../resources/js/router/route';
// import Router from "vue-router";

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faUserSecret, faPrint, faDownload, faPlus, faPenToSquare, faTrash, faDatabase, faGears, faClockRotateLeft, faEye, faUser, faArrowTurnRight } from '@fortawesome/free-solid-svg-icons'
/* add icons to the library */
library.add(faUserSecret, faPrint, faDownload, faPlus, faPenToSquare, faTrash, faDatabase, faGears, faClockRotateLeft, faEye, faUser, faArrowTurnRight)

const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: false, // if false, the window will not close after printing
    // windowTitle: window.document.title, // override the window title
}


axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://192.168.100.3:8000/'
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('header-component', require('./components/General/HeaderComponent.vue').default)
Vue.component('footer-component', require('./components/General/FooterComponent.vue').default)
/* add font awesome icon component */


Vue.use(VueSweetalert2);
Vue.use(VueHtmlToPaper, options);
// const NotFound =require('./components/HandlingError/NotFound.vue').default

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//  Vue.use(Router)

const app = new Vue({

    vuetify: Vuetify,
    el: '#app',
    router: router,
    pinia,


}).$mount('#app');
//


// const Auth = useAuth();
