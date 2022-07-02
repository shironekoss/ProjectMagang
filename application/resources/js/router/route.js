import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// cara1
const Home = require('../components/Pages/Home/Home.vue').default
const Login =require('../components/Pages/Login/Login.vue').default
const User =require('../components/Credential/User.vue').default
// cara 2
import NotFound from '../components/HandlingError/NotFound.vue'

const route = [
    {
        name:'Home',
        path:'/home',
        component: Home
    },
    {
        name:'Login',
        path:'/login',
        component: Login
    },
    {
        name:'User',
        path:'/user/:name?',
        component: User,
        props:true
    },

    {
        path:'*',
        component:NotFound
    }
]

const router = new VueRouter({
    mode:'history',
    routes:route
})

export default router
