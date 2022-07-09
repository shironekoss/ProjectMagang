<template>
    <div>
        <!-- <div class="container my-5">

            <div class="card" style="max-width:550px">
                <div class="card-body">
                    <h5 class="card-title">Daftar User</h5>
                    <ul class="list-group list-group-light"></ul> -->

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
                <a class="btn btn-link btn-rounded btn-sm me-2" href="#" role="button">View</a>
                <!-- <a class="btn btn-primary btn-rounded btn-sm" href="#" role="button" data-mdb-toggle="modal"
                                data-mdb-target="#exampleSideModal1"> -->
                <a class="btn btn-info btn-rounded btn-sm" style="margin-right: 5px;"
                    @click.prevent="lihatuser(account._id)">
                    Edit User
                </a>

                <!-- <a href="" @click.prevent="lihatuser(user.id)">{{ user.name }}</a> -->
                <a class="btn btn-danger btn-rounded btn-sm" style="margin-right: 5px;">
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

        <!-- </div>
            </div>
        </div> -->
    </div>
</template>
<script>
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
            // this.$router.push('/user/'+name.toLowerCase())
            //cara3
            this.$router.push({
                name: 'Profile',
                params: { id: idcari }
            })
        }
    }
}
</script>
