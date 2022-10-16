import Vue from 'vue'
import VueRouter from 'vue-router'
import pinia from '../../Stores/Pinia'
import {useAuth} from '../../Stores/Auth'

Vue.use(VueRouter)

// cara1
const Home = require('../components/Pages/Home/Home.vue').default
const Login =require('../components/Credential/Login.vue').default
const Profile =require('../components/Pages/Settings/Profile.vue').default
const Register =require('../components/Pages/Register/Register.vue').default
const InputNoSPK = require('../components/Pages/InputNoSPK/InputSPKComponent.vue').default
const DaftarSPK = require('../components/Pages/InputNoSPK/DaftarSPK.vue').default
const Master = require('../components/Pages/Master/Master.vue').default
const MasterList = require('../components/Pages/Master/MasterMenu.vue').default
const EditMaster = require('../components/Pages/Master/Masteredit.vue').default
// const inputadmin = require('../components/Pages/InputComponent/input.vue').default
const inputadmin = require('../components/Pages/InputComponent/inputtemp.vue').default
const history = require('../components/Pages/InputComponent/History.vue').default
const Cekresult = require('../components/Pages/InputComponent/ShowResultComponent.vue').default
const Settings = require('../components/Pages/Settings/Settings.vue').default
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
        component: Login,
        meta:{
            authPage:true
        }
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
        name:'Master',
        path:'/Master',
        component: Master
    },
    {
        name:'MasterEdit',
        path:'/Master/:id',
        component: EditMaster,
        props:true
    },
    {
        name:'MasterList',
        path:'/Masterlist',
        component: MasterList
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
        name:'Cekresult',
        path:'/Cekresult',
        component: Cekresult
    },
    {
        name:'Settings',
        path:'/Settings',
        component: Settings
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


// router.beforeEach((to)=>{
//     const user = useAuth();
//     console.log(user)
// })


// router.beforeEach(async(to, from, next)=>{
//     // if(to.meta.requireAuth){
//     //     const auth = useAuth(pinia);
//     //     // const user = await auth.getuser();
//     //     console.log(auth);
//     //     next();
//     //     // if(auth.user){
//     //     //     next()
//     //     // }else{
//     //     //     next({
//     //     //         name:'Login'
//     //     //     })
//     //     // }
//     // }
//     // // if(to.meta.authPage){
//     // //     const auth = useAuth();
//     // //     await auth.getuser()
//     // // }
// })

export default router
