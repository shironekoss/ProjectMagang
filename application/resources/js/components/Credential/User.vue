<template>
    <div>
        <section v-if="username">
            <h1> Hello {{ username}}</h1>
            <router-link :to="{name:'User'}">Kembali</router-link>
        </section>
        <section v-else>
            <h1>Anda belum login</h1>
            <ul >
                <li v-for="user in users">
                    id {{ user.id }} adalah
                    <!-- <router-link :to="profile_url(user.name)">{{ user.name }}</router-link> -->
                    <a href="" @click.prevent="lihatuser(user.name )">{{ user.name }}</a>
                </li>
            </ul>
        </section>
    </div>
</template>
<script>
    export default{
        props:['username'],
        data(){
            return{
                users:[
                    {id: 1, name:'Felis'},
                    {id: 2, name:'Charles'},
                    {id: 3, name:'Elfan'},
                ]
            }
        },
        methods:{
            profile_url(name){
               return '/user/'+name.toLowerCase()
            },
            // cara2
            lihatuser(name){
                // this.$router.push('/user/'+name.toLowerCase())
                //cara3
                this.$router.push({
                     name:'User',
                     params:{username:name.toLowerCase() }
                })
            }
        }
    }
</script>
