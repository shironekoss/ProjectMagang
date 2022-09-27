<template>
    <div>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="lightbox">
                    <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="" style="width: 45px; height: 45px"
                        class="rounded-circle" />
                </div>
                <div class=" ms-3 d-flex flex-column">
                    <div class="d-flex flex-row align-items-center">
                        <p class="fw-bold mb-0">{{ this.account.account_name }}</p>
                        <span class="badge rounded-pill badge-success mb-0 ms-2">Active</span>
                    </div>
                    <p class="text-muted mb-0">{{ tampilan_detail_dept() }}</p>
                    <p class="text-muted mb-0">{{ tampilan_detail_role() }}</p>
                </div>
            </div>
            <div class="d-flex flex-row">
                <a class="btn btn-info btn-rounded btn-sm" style="margin-right: 5px;"
                    @click.prevent="lihatuser(account._id)">
                    Edit User
                </a>
                <a class="btn btn-danger btn-rounded btn-sm" style="margin-right: 5px;"
                    @click.prevent="accountdelete()">
                    Delete
                </a>
                <div class="form-check form-switch">
                    <label class="form-check-label" for="flexSwitchCheckDefault">
                        on or off</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                        v-model="this.account.account_active" />
                </div>
            </div>
        </li>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    props: {
        account: {
            type: Object
        }
    },
    methods: {
        tampilan_detail_dept() {
            return "Dept : " + this.account.account_privileges.account_dept
        },
        tampilan_detail_role() {
            return "Role : " + this.account.account_privileges.title
        },
        lihatuser(idcari) {
            this.$router.push({
                name: 'Profile',
                params: { id: idcari }
            })
        },
        accountdelete() {
            axios.delete('/api/deleteaccount/' + this.account._id).then((response) => {
                if(response.data.status){
                    this.$noty.success(response.data.message)
                     this.$router.push({
                        name: 'User'
                    })
                }
            })
        },
    }
}
</script>
