<template>
    <div>
        <section v-if="id">
            <h1> Hello {{ detailuser.name }}</h1>
            <router-link :to="{ name: 'User' }">Kembali</router-link>
        </section>
        <section v-else>
            <h1>Anda belum login</h1>
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
    props: ['id'],
    data() {
        return {
            users: [],
            detailuser: {}
        }
    },
    watch:{
        '$route':'getUsers'
    },
    mounted() {
        this.getUsers()
    },
    methods: {
         getUsers() {
             axios.get('/api/users').then((response) => {
                console.log(response)
                this.users = response.data

                if(this.id){
                    this.detailuser = this.users.filter(item =>item.id == this.id)[0]
                    console.log(this.detailuser)
                }

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
                name: 'User',
                params: {id:idcari}
            })
        }
    }
}
</script>
