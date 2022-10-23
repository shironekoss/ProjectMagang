<template>
    <div>
        <v-app>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Daftar Stall
                            </v-toolbar-title>
                            <button class="btn btn-primary" @click="dialogTambah=true"> TAMBAH</button>
                        </v-toolbar>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Yakin Mau Menghapus&nbsp; <span
                                        v-html="namaStallHapus"></span> ?</v-card-title>
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
                                <div v-if="modeTambah">
                                    <v-card-title class="text-h5">Tambah Stall</v-card-title>
                                </div>
                                <div v-else="modeTambah">
                                    <v-card-title class="text-h5">Update Stall</v-card-title>
                                </div>
                                <v-container>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field label="Nama Stall" required v-model="NamaStall">
                                            <template #label>
                                                <span class="red--text"><strong>* </strong></span>Nama Stall
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-select :items="listdepartemen.data" item-text="text" item-value="value"
                                            v-model="NamaDepartemen" required class="form-control">
                                            <template #label>
                                                <span class="red--text"><strong>* </strong></span>Pilih Departemen
                                            </template>
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field required v-model="JumlahStall" type="number" hide-details
                                            single-line>
                                            <template #label>
                                                <span class="red--text"><strong>* </strong></span>Jumlah Stall
                                            </template>
                                        </v-text-field>
                                    </v-col>
                                </v-container>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDialogTambah">Cancel</v-btn>
                                    <div v-if="modeTambah">
                                        <v-btn color="blue darken-1" text @click="addStall">Save</v-btn>
                                    </div>
                                    <div v-else="modeTambah">
                                        <v-btn color="blue darken-1" text @click="updatestall">Update</v-btn>
                                    </div>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed color="teal lighten-3" @click="edit(item)">Edit</v-btn>
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
                { text: 'Nama Stall', value: 'NamaStall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Departemen', value: 'NamaDepartemen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Jumlah Stall', value: 'JumlahStall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            dialogDelete: false,
            dialogTambah: false,
            JumlahStall: null,
            NamaStall: "",
            NamaDepartemen: "",
            namaStallHapus: "",
            modeTambah: true,
            updateid:"",
        }
    },
    mounted() {
        this.getliststall(),
            this.getlistdepartemen()
    },
    watch: {
        dialogDelete(val) {
            val || this.closeDialogDelete()
        },
        dialogTambah(val) {
            val || this.closeDialogTambah()
        },
    },
    methods: {
        async getlistdepartemen() {
            await axios.get('/api/listdepartemen').then((response) => {
                this.listdepartemen = []
                this.listdepartemen = response.data
            })
        },
        getliststall() {
            axios.get('/api/liststall').then((response) => {
                this.datatable = []
                this.datatable = response.data.data
            })
        },
        addStall() {
            axios.post('/api/addstall', { JumlahStall: this.JumlahStall, NamaStall: this.NamaStall, NamaDepartemen: this.NamaDepartemen }).then((response) => {
                if (response.data.statusresponse == 400) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if (response.data.statusresponse == 200) {
                    this.closeDialogTambah()
                    this.$swal({
                        title: response.data.message,
                        icon: 'success'
                    });
                    this.getliststall();
                }
            })
        },
        updatestall(){
            axios.post('/api/updatestall', { JumlahStall: this.JumlahStall, NamaStall: this.NamaStall, NamaDepartemen: this.NamaDepartemen, id:this.updateid}).then((response) => {
                if (response.data.statusresponse == 400) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if (response.data.statusresponse == 200) {
                    this.closeDialogTambah()
                    this.$swal({
                        title: response.data.message,
                        icon: 'success'
                    });
                    this.getliststall();
                }
            })
        },
        closeDialogTambah() {
            this.dialogTambah = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.NamaDepartemen = ""
            this.JumlahStall = null
            this.NamaStall = ""
            this.modeTambah = true
            this.updateid=""
        },
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaStallHapus = ""
        },
        edit(item) {
            console.log(item);
            this.modeTambah = false
            this.dialogTambah = true
            this.NamaDepartemen = item["NamaDepartemen"]
            this.JumlahStall = item["JumlahStall"]
            this.NamaStall = item["NamaStall"]
            this.updateid = item["_id"]
        },
        deleteItem(item) {
            this.namaStallHapus = item.NamaStall
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]
            this.closeDialogDelete()
            axios.delete('/api/hapusstall' + datahapus["_id"]).then((response) => {
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
                    this.getliststall()
                }
            })
            this.closeDialogDelete()
        },
    }
}
</script>
<style>

</style>
