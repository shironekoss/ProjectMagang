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
                            <button class="btn btn-primary" @click="dialogTambah = true"> TAMBAH</button>
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
                                    <v-col cols="12" sm="6" md="10">
                                        <v-select :items="listTypeDatabase.data" item-text="text" item-value="value"
                                            v-model="selectdatabase" required class="form-control">
                                            <template #label>
                                                <span class="red--text"><strong>* </strong></span>Pilih Akses Database
                                                yang mau Diberikan
                                            </template>
                                        </v-select>
                                        <button class="btn btn-primary btn-dialog" @click="addAccess"> Tambah
                                            Akses</button>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field label="Database Access" class=".v-input-customclass" required
                                            v-model="DatabaseAccess" disabled>
                                        </v-text-field>
                                        <button class="btn btn-primary btn-dialog" @click="clearAccess"> Bersihkan
                                            Akses</button>
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
                        <v-dialog v-model="dialogUpdate" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Update Departemen</v-card-title>
                                <v-container>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field label="Nama Departemen" required v-model="namaDepartemen">
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-select :items="listTypeDatabase.data" item-text="text" item-value="value"
                                            v-model="selectdatabase" required class="form-control">
                                            <template #label>
                                                <span class="red--text"><strong>* </strong></span>Pilih Akses Database
                                                yang mau Diberikan
                                            </template>
                                        </v-select>
                                        <button class="btn btn-primary btn-dialog" @click="addAccess"> Tambah
                                            Akses</button>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="10">
                                        <v-text-field label="Database Access" class=".v-input-customclass" required
                                            v-model="DatabaseAccess" disabled>
                                        </v-text-field>
                                        <button class="btn btn-primary btn-dialog" @click="clearAccess"> Bersihkan
                                            Akses</button>
                                    </v-col>
                                </v-container>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDialogUpdate">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="updateDepartemen">Update</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed color="teal lighten-3" @click="updateItem(item)"
                            style="margin-right: 20px;">Update</v-btn>
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
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            dialogDelete: false,
            dialogTambah: false,
            dialogUpdate: false,
            namaDepartemen: "",
            namaDepartemenHapus: "",
            listTypeDatabase: [],
            selectdatabase: "",
            DatabaseAccess: [],

        }
    },
    mounted() {
        this.getlistdepartemen();
        this.getlisttype();
    },
    watch: {
        dialogDelete(val) {
            val || this.closeDialogDelete()
        },
        dialogTambah(val) {
            val || this.closeDialogTambah()
        },
        dialogUpdate(val) {
            val || this.closeDialogUpdate()
        },
    },
    methods: {
        getlistdepartemen() {
            axios.get('/api/showdepartemen').then((response) => {
                this.listdepartemen = []
                this.listdepartemen = response.data
                this.datatable = response.data.data
            })
        },
        addAccess() {
            if (this.selectdatabase == "") {
                this.$swal({
                    title: "pilih akses terlebih dahulu",
                    icon: 'error'
                });
            }
            var check = false;
            this.DatabaseAccess.forEach(element => {
                if (this.selectdatabase == element) {
                    check = true;
                }
            });
            if (check) {
                this.$swal({
                    title: "Role Akses sudah terdaftar",
                    icon: 'error'
                });
            }
            else {
                this.DatabaseAccess.push(this.selectdatabase)
            }
        },
        clearAccess() {
            this.DatabaseAccess = []
        },
        getlisttype() {
            axios.post('/api/showlisttype').then((response) => {
                this.listTypeDatabase = []
                this.listTypeDatabase = response.data
            })
        },
        addDepartemen() {
            axios.post('/api/adddepartemen', { namadepartemen: this.namaDepartemen, databaseakses: this.DatabaseAccess }).then((response) => {
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
        updateDepartemen() {
            var dataUpdate = this.datatable[this.editedIndex]
            axios.post('/api/updatedepartemen', { id:dataUpdate["_id"],namadepartemen: this.namaDepartemen, databaseakses: this.DatabaseAccess }).then((response) => {
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
            this.closeDialogUpdate()
        },
        closeDialogTambah() {
            this.dialogTambah = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaDepartemen = ""
            this.selectdatabase = ""
            this.DatabaseAccess = []
        },
        closeDialogUpdate() {
            this.dialogUpdate = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaDepartemen = ""
            this.selectdatabase = ""
            this.DatabaseAccess = []
        },
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.namaDepartemenHapus = ""
        },
        updateItem(item) {
            this.editedIndex = this.datatable.indexOf(item)
            var dataUpdate = this.datatable[this.editedIndex]
            console.log(dataUpdate)
            axios.post('/api/getupdatedept' + dataUpdate["_id"]).then((response) => {
                if (response.data.statusresponse == 400) {
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if (response.data.statusresponse == 200) {
                    this.namaDepartemen=response.data.data.Nama_Departemen
                    this.DatabaseAccess=response.data.data.AksesTipeDatabase
                }
            })
            this.dialogUpdate = true
        },
        deleteItem(item) {
            this.namaDepartemenHapus = item.Nama_Departemen
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]

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
<style scoped>
.btn {
    margin-left: 25px;
}

.btn-dialog {
    margin-left: 0px;
    margin-top: 15px;
}

.v-input--is-disabled input {
    color: rgba(0, 0, 0, 0.87);
}
</style>
