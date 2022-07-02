<template>
    <div>
        <section v-if="name">
            <h1> Hello {{ name}}</h1>
            <router-link to='/user'>Kembali</router-link>
        </section>
        <section v-else>
            <h1>Anda belum login</h1>
            <ul >
                <li v-for="user in users">
                    id {{ user.id }} adalah
                    <router-link :to="profile_url(user.name)">{{ user.name }}</router-link>
                </li>
            </ul>
        </section>
    </div>
</template>
<script>
    export default{
        props:['name'],
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
            }
        }
    }
</script>
