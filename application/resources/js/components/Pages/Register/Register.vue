<template>
    <div>
        <h1>Register</h1>
        <form @submit.prevent="handleSubmit" action="/users" method="post">
            <div class="input-group">
                <label>Nama</label>
                <input type="text" v-model="form.name">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text"  v-model="form.email">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="text" v-model="form.password">
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                form:{
                    name:' ',
                    email: ' ',
                    password:' '
                }
            }
        },
        methods:{
            handleSubmit(){
                console.log(this.form)
                axios.post('/api/users',this.form).then((response)=>{
                     console.log(response)
                }).catch((error)=>{
                    console.log(error)
                })
            }
        }
    }
</script>
<style>
    .input-group{
        margin-bottom: 5px ;
    }
</style>
