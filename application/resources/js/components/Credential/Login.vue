    <template>
        <div>
            <div class="login-page">
                <!-- <transition name="fade">
                    <div v-if="!registerActive" class="wallpaper-login"></div>
                </transition> -->
                <!-- <div class="wallpaper-register"></div> -->
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
                                <input type="submit" class="btn btn-primary">
                                <p>Don't have an account? <a href="#"
                                        @click="registerActive = !registerActive, emptyFields = false">Sign up here</a>
                                </p>
                                <p><a href="#">Forgot your password?</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
<script >
import { reactive } from 'vue';
import { useAuth } from '../../../Stores/Auth'
import Swal from 'sweetalert2'

const user = reactive({
    username: '',
    password: '',
});
export default {
    setup() {
        const Auth = useAuth();
        return { Auth }
    },
    methods: {
        Login() {
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
}
</script>

<style lang="scss">
p {
    line-height: 1rem;
}

.card {
    padding: 20px;
}

.form-group {
    input {
        margin-bottom: 20px;
    }
}

.login-page {
    align-items: center;
    display: flex;
    height: 100vh;

    .wallpaper-login {
        background: url(https://images.pexels.com/photos/32237/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
        background-size: cover;
        height: 100%;
        position: absolute;
        width: 100%;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }

    .wallpaper-register {
        background: url(https://images.pexels.com/photos/533671/pexels-photo-533671.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
        background-size: cover;
        height: 100%;
        position: absolute;
        width: 100%;
        z-index: -1;
    }

    h1 {
        margin-bottom: 1.5rem;
    }
}

.error {
    animation-name: errorShake;
    animation-duration: 0.3s;
}

@keyframes errorShake {
    0% {
        transform: translateX(-25px);
    }

    25% {
        transform: translateX(25px);
    }

    50% {
        transform: translateX(-25px);
    }

    75% {
        transform: translateX(25px);
    }

    100% {
        transform: translateX(0);
    }
}
</style>
