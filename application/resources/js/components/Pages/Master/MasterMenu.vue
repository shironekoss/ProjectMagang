<template>
    <div>
        <v-app>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10" :search="search"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>Tambahkan Master

                            </v-toolbar-title>
                            <button class="btn btn-primary" @click="TambahMaster" style="margin-left: 30px;">
                              Tambah Master   <font-awesome-icon icon="fa-solid fa-plus" />  </button>
                        </v-toolbar>
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details>
                            </v-text-field>
                        </v-card-title>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Yakin Mau Menghapus&nbsp; <span
                                        v-html="NamaKitHapus"></span> ?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDialogDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed color="teal lighten-3" @click="editmaster(item)">Edit</v-btn>
                        <v-btn depressed color="error" @click="deleteItem(item)">Hapus</v-btn>
                    </template>
                </v-data-table>
            </div>
        </v-app>
    </div>
</template>

<script>
import axios from 'axios'
import ConvertTime from '../../../Helper/ConvertTime'
export default {
    mixins:[ConvertTime],
    data() {
        return {
            listMaster: [],
            search: '',
            datatable: [],
            headerstable: [
                { text: 'Kode Kit', value: 'NamaKit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', value: 'Kodekit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Waktu Update', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            dialogDelete: false,
            dialogTambah: false,
            NamaKitHapus: "",
        }
    },
    mounted() {
        this.getlistmaster();
        // this.getdatatable();
    },
    watch: {
        // state() {
        //     this.filterstates();
        // },
        dialogDelete(val) {
            val || this.closeDialogDelete()
        },

    },
    methods: {
        getlistmaster() {
            axios.get('/api/listmaster').then((response) => {
                this.listMaster = []
                this.listMaster = response.data
                this.datatable = response.data.data
                this.datatable.forEach(element => {
                    element["updated_at"]=this.converttime(element["updated_at"])
                });
                // this.listspk.forEach(element => {
                //     this.states.push(element.NOSPK)
                // });
                // this.filterstates();
            })
        },
        TambahMaster() {
            this.$router.push('Master')
        },
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
            this.NamaKitHapus = ""
        },
        editmaster(item) {
            this.$router.push({
                name: 'MasterEdit',
                params: { id: item['_id'] }
            })
        },
        deleteItem(item) {
            this.NamaKitHapus = item.NamaKit
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]
            this.closeDialogDelete()
            axios.delete('/api/hapusmaster' + datahapus["_id"]).then((response) => {
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
                    this.getlistmaster()
                }
            })
            this.closeDialogDelete()
        },
    }
}
</script>
<style>

</style>
