import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// cara1
const Home = require('../components/Pages/Home/Home.vue').default
const Login =require('../components/Pages/Login/Login.vue').default
const User =require('../components/Credential/User.vue').default
const Profile =require('../components/Pages/Profile/Profile.vue').default
const Register =require('../components/Pages/Register/Register.vue').default
const InputNoSPK = require('../components/Pages/InputNoSPK/InputSPKComponent.vue').default
const DaftarSPK = require('../components/Pages/InputNoSPK/DaftarSPK.vue').default
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
        name:'Profile',
        path:'/user/:id',
        component: Profile,
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
