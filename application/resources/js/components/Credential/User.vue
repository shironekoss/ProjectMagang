<template>
    <div>
        <h1>Anda belum login</h1>

        <router-link :to="{ name: 'Register' }" class="btn btn-primary">Register</router-link>
        <div class="container my-6">
            <div class="card" style="max-width:650px">
                <div class="card-body">
                    <h5 class="card-title">Daftar User</h5>
                    <ul class="list-group list-group-light"></ul>
                    <div v-for="account in accounts">
                        <div v-if="!account.deleted_at">
                        <UserdetailVue :account="account"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import UserdetailVue from './Userdetail.vue'
export default {
    components: { UserdetailVue },
    data() {
        return {
            accounts: [],
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        getUsers() {
            axios.get('/api/accounts/'+this.accounts).then((response) => {
                this.accounts = response.data
            })
        },

    }
}
</script>


