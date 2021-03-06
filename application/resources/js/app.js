/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from 'vue'
// import { createPinia, PiniaVuePlugin } from 'pinia'
import router from './router/route.js'


// vue Noty
import VueNoty from 'vuejs-noty'
// Vue.use(PiniaVuePlugin);
Vue.use(VueNoty, {
    timeout: 5000,
    progressBar: true,
    layout: 'topRight'
})
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', require('./components/General/HeaderComponent.vue').default);
Vue.component('footer-component', require('./components/General/FooterComponent.vue').default);



// untuk latihan
Vue.component('latihanbutton', require('./components/Pages/InputNoSPK/SpkInputtrigger.vue').default);

// const NotFound =require('./components/HandlingError/NotFound.vue').default


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
    data: {
        title: 'Rancangan Program SPK'
    },
    router,
});
