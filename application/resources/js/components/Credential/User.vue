<template>
    <div>
        <section >
            <h1>Anda belum login</h1>
            <router-link :to="{name:'Register'}">Register</router-link>
            <ul>
                <li v-for="user in users">
                    id {{ user.id }} adalah
                    <!-- <router-link :to="profile_url(user.name)">{{ user.name }}</router-link> -->
                    <a href="" @click.prevent="lihatuser(user.id)">{{ user.name }}</a>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
         getUsers() {
             axios.get('/api/users').then((response) => {
                console.log(response)
                this.users = response.data

            })
        },
        profile_url(name) {
            return '/user/' + name.toLowerCase()
        },
        // cara2
        lihatuser(idcari) {
            // this.$router.push('/user/'+name.toLowerCase())
            //cara3
            this.$router.push({
                name: 'Profile',
                params: {id:idcari}
            })
        }
    }
}
</script>
