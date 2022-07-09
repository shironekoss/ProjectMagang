<template>
    <div>
        <section v-if="id">
            <h1> Hello {{ detailuser.account_name }}</h1>
            <p> Jabatan : {{ detailuser.account_privileges.title }}</p>
            <p> Departemen : {{ detailuser.account_privileges.account_dept}}</p>
            <router-link :to="{ name: 'User' }">Kembali</router-link>
        </section>
    </div>
</template>

<script>
export default {
    props: ['id'],
    data() {
        return {
            detailuser: {}
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
         getUser() {
             axios.get('/api/users/'+this.id).then((response) => {
                console.log(response)
                this.detailuser  = response.data
            })
        },
    }
}
</script>
