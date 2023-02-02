
import Vue from 'vue';
import pinia from '../../Stores/Pinia';

import VueRouter from 'vue-router'
import { useAuth } from '../../Stores/Auth'

Vue.use(VueRouter)


const routes = [
    {
        name: 'Home',
        path: '/',
        component: () => import("../components/Pages/Home/Home.vue"),
        meta: {
            guestPageAccess: true,
        }
    },
    {
        name: 'Register', // register user baru
        path: '/user/create',
        component: () => import("../components/Pages/Register/Register.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Super Admin Role'
        }
    },
    {
        name: 'Profile',
        path: '/user/:id',
        component: () => import("../components/Pages/Settings/Profile.vue"),
        props: true,
        meta: {
            guestPageAccess: false,
            levelAccess: 'Admin Role'
        }
    },
    {
        name: 'Master',
        path: '/Master',
        component: () => import("../components/Pages/Master/Master.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Admin Role'
        }
    },
    {
        name: 'MasterEdit',
        path: '/Master/:id',
        component: () => import("../components/Pages/Master/Masteredit.vue"),
        props: true,
        meta: {
            guestPageAccess: false,
            levelAccess: 'Admin Role'
        }
    },
    {
        name: 'MasterList',
        path: '/Masterlist',
        component: () => import("../components/Pages/Master/MasterMenu.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Admin Role'
        }
    },
    {
        name: 'Inputadmin', // generate komponen dari KodeSPK
        path: '/inputadmin',
        component: () => import("../components/Pages/InputComponent/inputAdmin.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Staff Role'
        }
    },
    {
        name: 'History', // history input admin
        path: '/history',
        component: () => import("../components/Pages/InputComponent/History.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Staff Role'
        }
    },
    {
        name: 'Cekresult', // belum tahu
        path: '/Cekresult',
        component: () => import("../components/Pages/InputComponent/ShowResultComponent.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Staff Role'
        }
    },
    {
        name: 'CheckresultSingleHistory',
        path: '/Cekresult/:name',
        component: () => import("../components/Pages/InputComponent/ShowResultSingle.vue"),
        props: true,
        meta: {
            guestPageAccess: false,
            levelAccess: 'Staff Role'
        }
    },
    {
        name: 'CheckFull', // manajemen user dan departemen
        path: '/CheckFull',
        component: () => import("../components/Pages/Checkfull/CheckFull.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Super Admin Role'
        }
    },
    {
        name: 'CheckFullDetail', // manajemen user dan departemen
        path: '/CheckFull/:nospk',
        component: () => import("../components/Pages/Checkfull/CheckFullDetail.vue"),
        props: true,
        meta: {
            guestPageAccess: false,
            levelAccess: 'Super Admin Role'
        }
    },
    {
        name: 'Settings', // manajemen user dan departemen
        path: '/Settings',
        component: () => import("../components/Pages/Settings/Settings.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Super Admin Role'
        }
    },
    {
        name: 'ManageInputSPK', // manajemen user dan departemen
        path: '/ManageInputSPK',
        component: () => import("../components/Pages/InputComponent/ManageInputNoSPk.vue"),
        meta: {
            guestPageAccess: false,
            levelAccess: 'Admin Role'
        }
    },
    {
        name: 'Login',
        path: '/login',
        component: () => import("../components/Credential/Login.vue"),
        meta: {
            guestPageAccess: true
        }
    },
    {
        name: 'NotFound',
        path: '*',
        component: () => import("../components/HandlingError/NotFound.vue"),

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
    const store = useAuth();
    // console.log(store.user.account_privileges)
    if (!to.meta.guestPageAccess) {
        store.getUser();
        // console.log(store.user.account_privileges.title)
        if (store.user) {
            if (store.user.account_privileges.title == "Super Admin Role") {
                next()
            }
            else if (store.user.account_privileges.title == "Admin Role") {
                if (to.meta.levelAccess == "Admin Role" || to.meta.levelAccess == "Staff Role") {

                    next()
                }
            }
            else if (store.user.account_privileges.title == "Staff Role") {
                if (to.meta.levelAccess == "Staff Role") {
                    next()
                }
            }
            else {

                next({
                    name: 'NotFound'
                })
            }
        } else {
            next({
                name: 'Login'
            })
        }
    }
    else {
        next()
    }
})


export default router
