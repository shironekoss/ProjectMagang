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
        path:'/home',
        component: Home
    },
    {
        path:'/login',
        component: Login
    },
    {
        path:'/user/:name',
        component: User
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
