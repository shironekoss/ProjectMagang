import axios from "axios";
import { defineStore } from "pinia";
import { ref ,watch} from "vue";

export const useAuth = defineStore('auth-store',()=>{
    const user = ref(null);

    if(localStorage.getItem("user")){
        user.value = JSON.parse(localStorage.getItem("user"));
        console.log('retrievedObject: ');
    }

    watch(
        user,
        (userval)=>{
            localStorage.setItem("user",JSON.stringify(userval));
        },
        {deep:true}
    );

    const register = async function(credentials){
        try {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/register',credentials);
            authenticated.value = true;
            getuser();
        } catch (err) {
            user.value = {};
            console.error('Error loading new arrivals:',err);
            return err
        }
    };


    const Login = async function(data){
        try {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/api/login',data).then((response) => {
                if(response.data[0]==null){
                    user.value = null
                }
                else{
                    user.value=response.data[0].user
                }

                console.log(response.data[0]);
                // getuser();

            });
        } catch (error) {
            user.value = null;
            console.error('Login gagal',error);
            return error;
        }
    };

    const getuser = async function(){
        try {
            const response = await axios.get('/api/user');
            user.value = response.data;
            return response.data
        } catch (error) {
            console.error('gagal fetch user',error);
            return error;
        }
    }

    const logout = async function (){
        try {
            await axios.post('/logout');
            user.value=null;
        } catch (error) {
            console.error('error logout :', error);
            return err;
        }
    }

    return {
        user,
        Login,
        getuser,
        logout,
    }
});


// export const useAuth = defineStore('auth-store',{
//     state: ()=>{
//         return{
//             users:[],
//         }
//     },
//     actions:{
//         create(user){
//             this.users.push({
//                 ...user,
//             })
//         },
//         delete(){
//             this.users=[]
//         }
//     },
//     getters:{
//         getuser(state){
//             return state.users
//         }
//     }

// });
