import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// cara1
const Home = require('../components/Pages/Home/Home.vue').default
const Login =require('../components/Pages/Login/Login.vue').default
const User =require('../components/Credential/User.vue').default
const Userdetail =require('../components/Credential/Profile.vue').default
const Register =require('../components/Pages/Register/Register.vue').default
const InputNoSPK = require('../components/Pages/InputNoSPK/InputSPKComponent.vue').default
const DaftarSPK = require('../components/Pages/InputNoSPK/DaftarSPK.vue').default
const Master = require('../components/Pages/Master/Master.vue').default
const inputadmin = require('../components/Pages/InputComponent/input.vue').default
const history = require('../components/Pages/InputComponent/History.vue').default
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
        path:'/user',
        component: User,
    },
    {
        name:'Register',
        path:'/user/create',
        component: Register,
    },
    {
        name:'Userdetail',
        path:'/user/:id',
        component: Userdetail,
        props:true
    },
    {
        name:'InputNoSPK',
        path:'/inputspk',
        component: InputNoSPK
    },
    {
        name:'DaftarSPK',
        path:'/DaftarSPK',
        component: DaftarSPK
    },
    {
        name:'Master',
        path:'/Master',
        component: Master
    },
    {
        name:'Inputadmin',
        path:'/inputadmin',
        component: inputadmin
    },
    {
        name:'History',
        path:'/history',
        component: history
    },
    {
        path:'*',
        component:NotFound
    }
]

const router = new VueRouter({
    linkActiveClass: 'active',
    mode:'history',
    routes:route
})

export default router
