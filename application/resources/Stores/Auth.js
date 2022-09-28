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
    const Login = async function(data){
        try {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/api/login',data).then((response) => {
                if(response.data[0]==null){
                    user.value = null
                }
                else{
                    user.value=response.data[0]
                }
                console.log(response.data[0]);

            });
        } catch (error) {
            user.value = null;
            console.error('Login gagal',error);
            return error;
        }
    }

    const getuser = async function(){
        // try {
        //     const response = await axios.get('/api/user');
        //     user.value = response.data;
        //     return response.data
        // } catch (error) {
        //     console.error('gagal fetch user',error);
        //     return error;
        // }
        return user;
    }

    return {
        user,
        Login,
        getuser,
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
