<template>
    <div>
        <div class="mainscreen">
            <!-- <img src="https://image.freepik.com/free-vector/purple-background-with-neon-frame_52683-34124.jpg"  class="bgimg " alt="">-->
            <div class="card">
                <div class="leftside">
                    <img src="https://i.pinimg.com/originals/18/9d/dc/189ddc1221d9c1c779dda4ad37a35fa1.png"
                        class="product" alt="Shoes" />
                </div>
                <div class="rightside">
                    <form @submit.prevent="handleSubmit">
                        <h1>Register</h1>
                        <h2>Register Information</h2>
                        <p>Username</p>
                        <input type="text" class="inputbox" v-model="form.username">
                        <div class="error" v-if="errors.username">
                            {{ errors.username[0] }}
                        </div>
                        <p>Full Name</p>
                        <input type="text" v-model="form.name" class="inputbox">
                        <div class="error" v-if="errors.name">
                            {{ errors.name[0] }}
                        </div>
                        <p>Password</p>
                        <div class="error" v-if="errors.password">
                            {{ errors.password[0] }}
                        </div>
                        <input type="password" v-model="form.password" class="inputbox">
                        <p>Confirmation Password</p>
                        <input type="password" v-model="form.password_confirmation" class="inputbox">
                        <p>Role</p>
                        <select class="inputbox" name="card_type" id="card_type" v-model="form.role">
                            <option value="">--Select Role--</option>
                            <option value="Super_Admin_role">Super Admin</option>
                            <option value="Admin_role">Admin</option>
                            <option value="Staff_role">Staff</option>
                        </select>
                        <div class="error" v-if="errors.role">
                            {{ errors.role[0] }}
                        </div>
                        <p>Departemen</p>
                        <input type="text" v-model="form.departemen" class="inputbox">
                        <div class="error" v-if="errors.departemen">
                            {{ errors.departemen[0] }}
                        </div>
                        <button type="submit" class="button">Register Now !</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import { useTimer } from '../../../../Stores/Timer';
export default {
    setup() {
        const timerstore = useTimer();
        return {timerstore }
    },
    data() {
        return {
            form: {
                name: '',
                username: '',
                password: '',
                password_confirmation: '',
                role: '',
                departemen: '',
            },
            errors: {}
        }
    },
    onIdle() {
        this.timerstore.LogoutTimers()
    },
    methods: {
        handleSubmit() {
            console.log(this.form)
            axios.post('/api/tambahaccount', this.form).then((response) => {
                if (response.data.status) {
                    this.$swal({
                        title:'User Baru Berhasil dibuat!',
                        icon:'success'
                        });
                }
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        }
    }
}
</script>
<style scoped>
body {
    font-family: 'Roboto', sans-serif !important;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.error {
    color: red;
}

.mainscreen {
    min-height: 100vh;
    width: 100%;
    display: flex;
    flex-direction: column;
    background-color: #DFDBE5;
    background-image: url("https://wallpaperaccess.com/full/3063067.png");
    color: #963E7B;
}

.card {
    width: 60rem;
    margin: auto;
    background: white;
    position: center;
    align-self: center;
    /* top: 10rem; */
    border-radius: 1.5rem;
    box-shadow: 4px 3px 20px #3535358c;
    display: flex;
    flex-direction: row;

}

.leftside {
    background: #030303;
    width: 25rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}

.product {
    object-fit: cover;
    width: 20em;
    height: 20em;
    border-radius: 100%;
}

.rightside {
    background-color: #ffffff;
    width: 35rem;
    border-bottom-right-radius: 1.5rem;
    border-top-right-radius: 1.5rem;
    padding: 1rem 2rem 3rem 3rem;
}

p {
    display: block;
    font-size: 1.1rem;
    font-weight: 400;
    margin: .8rem 0;
    cursor: default;
}

.inputbox {
    color: #030303;
    width: 100%;
    padding: 0.3rem;
    border: none;
    border-bottom: 1px solid #ccc;
    margin-bottom: 1rem;
    border-radius: 0.3rem;
    font-family: 'Roboto', sans-serif;
    color: #615a5a;
    font-size: 1.1rem;
    font-weight: 500;
    outline: none;
}

.button {
    background: linear-gradient(135deg, #753370 0%, #298096 100%);
    padding: 15px;
    border: none;
    border-radius: 50px;
    color: white;
    font-weight: 400;
    font-size: 1.2rem;
    margin-top: 10px;
    width: 100%;
    letter-spacing: .11rem;
    outline: none;
}

.button:hover {
    transform: scale(1.05) translateY(-3px);
    box-shadow: 3px 3px 6px #38373785;
}

@media only screen and (max-width: 1000px) {
    .card {
        flex-direction: column;
        width: auto;

    }

    .leftside {
        width: 100%;
        border-top-right-radius: 0;
        border-bottom-left-radius: 0;
        border-top-right-radius: 0;
        border-radius: 0;
    }

    .rightside {
        width: auto;
        border-bottom-left-radius: 1.5rem;
        padding: 0.5rem 3rem 3rem 2rem;
        border-radius: 0;
    }
}
</style>
