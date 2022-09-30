<template>
    <div>
        <v-app>

            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Daftar Departemen
                            </v-toolbar-title>
                            <button class="btn btn-primary" @click="dialogTambah=true"> TAMBAH</button>
                        </v-toolbar>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Yakin Mau Menghapus&nbsp; <span
                                        v-html="namaDepartemenHapus"></span> ?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDialogDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogTambah" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Tambah Departemen</v-card-title>
                                <v-container>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field label="Nama Departemen" required v-model="namaDepartemen">
                                        </v-text-field>
                                    </v-col>
                                </v-container>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDialogTambah">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="addDepartemen">Save</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed color="error" @click="deleteItem(item)">Hapus</v-btn>
                    </template>
                </v-data-table>
            </div>
        </v-app>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            listdepartemen: [],
            datatable: [],
            headerstable: [
                { text: 'Nama Departemen', value: 'Nama_Departemen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Jumlah Account', value: 'Jumlah_account', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            dialogDelete: false,
            dialogTambah: false,
            namaDepartemen: "",
            namaDepartemenHapus: "",
        }
    },
    mounted() {
        this.getlistdepartemen();
        // this.getdatatable();
    },
    watch: {
        // state() {
        //     this.filterstates();
        // },
        dialogDelete(val) {
            val || this.closeDialogDelete()
        },
        dialogTambah(val) {
            val || this.closeDialogTambah()
        },
    },
    methods: {
        getlistdepartemen() {
            axios.get('/api/showdepartemen').then((response) => {
                this.listdepartemen = []
                this.listdepartemen = response.data
                this.datatable = response.data.data
                // this.listspk.forEach(element => {
                //     this.states.push(element.NOSPK)
                // });
                // this.filterstates();
            })
        },
        addDepartemen() {
            axios.post('/api/adddepartemen', { namadepartemen: this.namaDepartemen }).then((response) => {
                this.closeDialogTambah()
                if (response.data.statusresponse == 400) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if (response.data.statusresponse == 200) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'success'
                    });
                    this.getlistdepartemen();
                }
            })
        },
        closeDialogTambah() {
            this.dialogTambah = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaDepartemen = ""
        },
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaDepartemenHapus = ""
        },
        deleteItem(item) {
            this.namaDepartemenHapus = item.Nama_Departemen
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]
            this.closeDialogDelete()
            axios.delete('/api/hapusdepartemen' + datahapus["_id"]).then((response) => {
                if (response.data.statusresponse == 400) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if (response.data.statusresponse == 200) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'success'
                    });
                    this.getlistdepartemen()
                }
            })
            this.closeDialogDelete()
        },
    }
}
</script>
<style>

</style>
