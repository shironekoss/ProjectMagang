<template>
    <div>
        <div class="login-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
                        <!-- <div v-if="!registerActive" class="card login" v-bind:class="{ error: emptyFields }"> -->
                        <!-- <h1>Sign In <font-awesome-icon icon="fa-solid fa-right-to-line" /></h1> -->
                        <h1>Sign In</h1>
                        <form class="form-group" @submit.prevent="Login">
                            <input v-model="user.username" type="text" class="form-control" placeholder="Username"
                                required>
                            <input v-model="user.password" type="password" class="form-control" placeholder="Password"
                                required>
                            <input type="submit" value="Login" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAuth } from "../../../Stores/Auth";
import Swal from 'sweetalert2'

export default {
    setup(){
        const Auth = useAuth();
        return {Auth}
    },
    data() {
        return {
            user:{
                username:"",
                password:""
            },
        };
    },
    computed:{

    },
    methods: {
        async Login() {
            await this.Auth.handleLogin(this.user);
            if (this.Auth.user == null) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Periksa kembali username dan password anda',
                })
            }
            else {
                this.$router.push({ name: 'Home' })
            }
        },
    }
};
</script>

<style scoped>
input{
    margin-top: 10px;
}
</style>
