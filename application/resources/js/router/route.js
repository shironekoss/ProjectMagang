
import Vue from 'vue';
import pinia from '../../Stores/Pinia';

import VueRouter from 'vue-router'
import { useAuth } from '../../Stores/Auth'

Vue.use(VueRouter)

// cara1
const Login = require('../components/Credential/Logintemp.vue').default
const Profile = require('../components/Pages/Settings/Profile.vue').default
const Register = require('../components/Pages/Register/Register.vue').default
const InputNoSPK = require('../components/Pages/InputNoSPK/InputSPKComponent.vue').default
const DaftarSPK = require('../components/Pages/InputNoSPK/DaftarSPK.vue').default
const Master = require('../components/Pages/Master/Master.vue').default
const MasterList = require('../components/Pages/Master/MasterMenu.vue').default
const EditMaster = require('../components/Pages/Master/Masteredit.vue').default
// const inputadmin = require('../components/Pages/InputComponent/input.vue').default
const inputadmin = require('../components/Pages/InputComponent/inputtemp.vue').default
const history = require('../components/Pages/InputComponent/History.vue').default
const Cekresult = require('../components/Pages/InputComponent/ShowResultComponent.vue').default
const CekresultSingle = require('../components/Pages/InputComponent/ShowResultSingle.vue').default
const Settings = require('../components/Pages/Settings/Settings.vue').default
const CheckFull = require('../components/Pages/Checkfull/CheckFull.vue').default
const CheckFullDetail = require('../components/Pages/Checkfull/CheckFullDetail.vue').default
// cara 2
import NotFound from '../components/HandlingError/NotFound.vue'

const routes = [
    {
        name: 'Home',
        path: '/',
        component: () => import("../components/Pages/Home/Home.vue"),
        meta: {
            guestPageAccess: true
        }
    },
    {
        name: 'Register', // register user baru
        path: '/user/create',
        component: Register,
    },
    {
        name: 'Profile',
        path: '/user/:id',
        component: Profile,
        props: true
    },
    {
        name: 'InputNoSPK', // tidak dipakai
        path: '/inputspk',
        component: InputNoSPK
    },
    {
        name: 'DaftarSPK',
        path: '/DaftarSPK',
        component: DaftarSPK
    },
    {
        name: 'Master',
        path: '/Master',
        component: Master
    },
    {
        name: 'MasterEdit',
        path: '/Master/:id',
        component: EditMaster,
        props: true
    },
    {
        name: 'MasterList',
        path: '/Masterlist',
        component: MasterList
    },
    {
        name: 'Inputadmin', // generate komponen dari KodeSPK
        path: '/inputadmin',
        component: inputadmin
    },
    {
        name: 'History', // history input admin
        path: '/history',
        component: history
    },
    {
        name: 'Cekresult', // belum tahu
        path: '/Cekresult',
        component: Cekresult
    },
    {
        name: 'CheckresultSingleHistory',
        path: '/Cekresult/:name',
        component: CekresultSingle,
        props: true
    },
    {
        name: 'CheckFull', // manajemen user dan departemen
        path: '/CheckFull',
        component: CheckFull
    },
    {
        name: 'CheckFullDetail', // manajemen user dan departemen
        path: '/CheckFull/:nospk',
        component: CheckFullDetail,
        props: true
    },
    {
        name: 'Settings', // manajemen user dan departemen
        path: '/Settings',
        component: Settings,
        meta:{
            requireAuth:true
        }
    },
    {
        name: 'Login',
        path: '/login',
        component: Login,
        meta: {
            guestPageAccess: true
        }
    },
    {
        path: '*',
        component: NotFound
    }
]

const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes: routes
})

// router.beforeEach( (to, from, next) => {
//     const userStore = useAuth()
// })

router.beforeEach((to, from, next) => {
    // ...
    // explicitly return false to cancel the navigation
    console.log("hai")
    const store = useAuth(pinia);

    if (to.meta.requireAuth) {
         store.getUser();
        console.log(store.user)
        if (authStore.user) {
            next()
        } else {
            next({
                name: 'Login'
            })
        }
    }
    next()
})

// router.beforeEach((to, from, next) => {
//     // we wanted to use the store here
//     if (store.isLoggedIn) next()
//     else next('/login')
// })

// router.beforeEach((to) => {
//     // ✅ This will work because the router starts its navigation after
//     // the router is installed and pinia will be installed too
//     const store = useAuth();

//     // if (to.meta.requiresAuth && !store.isLoggedIn) return '/login'
// })

export default router
