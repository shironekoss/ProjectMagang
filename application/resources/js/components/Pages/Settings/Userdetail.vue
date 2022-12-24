<template>
    <div>
        <div>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="lightbox">
                        <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt=""
                            style="width: 45px; height: 45px" class="rounded-circle" />
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
                        Edit User <font-awesome-icon icon="fa-solid fa-pen-to-square" style="margin-left: 5px;" />
                    </a>
                    <div v-if="this.account.account_privileges.title != 'Super Admin Role'">
                        <a class="btn btn-danger btn-rounded btn-sm" style="margin-right: 5px;"
                            @click.prevent="accountdelete()">
                            Delete <font-awesome-icon icon="fa-solid fa-trash" style="margin-left: 5px;" />
                        </a>
                    </div>

                    <div class="form-check form-switch">
                        <label class="form-check-label" for="flexSwitchCheckDefault">
                            on or off</label>
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                            v-model="this.account.account_active" />
                    </div>
                </div>
            </li>
        </div>
        <div>
            <v-app style="min-height: 0;">
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Yakin Mau Menghapus&nbsp; <span v-html="namaAkunHapus"></span>
                            ?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDialogDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-app>
        </div>
    </div>
</template>
<script>
import axios from 'axios'

export default {
    props: {
        account: {
            type: Object
        },
    },
    data() {
        return {
            dialogDelete: false,
            namaAkunHapus: "",
        }
    },
    watch: {
        dialogDelete(val) {
            val || this.closeDialogDelete()
        },
    },
    methods: {
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaAkunHapus = ""
        },
        deleteItemConfirm() {
            axios.delete('/api/deleteaccount/' + this.account._id).then((response) => {
                if (response.data.status) {
                    this.$swal({
                        title: "username "+ this.namaAkunHapus+" berhasil dihapus",
                        icon: 'success'
                    });
                    this.closeDialogDelete()
                    this.$router.go()
                }
                else{
                    this.$swal({
                        title: "gagal menghapus username "+ this.namaAkunHapus,
                        icon: 'error'
                    });
                    this.closeDialogDelete()
                }
            })
        },
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
            console.log(this.account)
            this.namaAkunHapus = this.account.account_name
            this.dialogDelete = true
        },
    }
}
</script>

<style scoped lang="scss">
::v-deep .v-application--wrap {
    min-height: fit-content;
}
</style>
