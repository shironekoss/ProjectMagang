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
                                <v-card-title class="text-h5">Yakin Mau Menghapus Item ini ?</v-card-title>
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
                                        <v-text-field label="Nama Departemen" required v-model="namaDepartemen" ></v-text-field>
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
            namaDepartemen:"",
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
        addDepartemen(){
            // console.log(this.namaDepartemen)
            axios.post('/api/adddepartemen',{namadepartemen:this.namaDepartemen}).then((response)=>{
                this.closeDialogTambah()
                if(response.data.statusresponse==400){
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
                else if(response.data.statusresponse==200){
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
            this.namaDepartemen=""
        },
        closeDialogDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
        },
        deleteItem(item) {
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]
            console.log(datahapus)
            // axios.delete('/api/hapusdatatable' + datahapus["_id"]).then((response) => {
            //     if (response.data.status == 200) {
            //         this.$swal({
            //             title: 'Sukses Hapus Data',
            //             icon: 'success'
            //         });
            //         this.getdatatable();
            //     } else if (response.data.status == 400) {
            //         this.$swal({
            //             title: 'Gagal Hapus Data',
            //             icon: 'error'
            //         });
            //     }
            // })
            this.closeDialogDelete()
        },
        // },
        // closeDelete() {
        //     this.dialogDelete = false
        //     this.$nextTick(() => {
        //         this.editedIndex = -1
        //     })
        // },
        // deleteItem(item) {
        //     this.editedIndex = this.datatable.indexOf(item)
        //     this.dialogDelete = true
        // },
        // deleteItemConfirm() {
        //     var datahapus = this.datatable[this.editedIndex]
        //     axios.delete('/api/hapusdatatable' + datahapus["_id"]).then((response) => {
        //         if (response.data.status == 200) {
        //             this.$swal({
        //                 title: 'Sukses Hapus Data',
        //                 icon: 'success'
        //             });
        //             this.getdatatable();
        //         }else if(response.data.status == 400){
        //             this.$swal({
        //                 title: 'Gagal Hapus Data',
        //                 icon: 'error'
        //             });
        //         }
        //     })
        //     this.closeDelete()
        // },
        // async getdatatable() {
        //     await axios.get('/api/getdatatable').then((response) => {
        //         this.datatable = []
        //         this.datatable = response.data.reverse()
        //         var i = 0;
        //     })
        // },
        // pindahhistory() {
        //     this.$router.push({
        //         name: 'History'
        //     })
        // },
        // hapus(index) {
        //     axios.post('/api/hapusspkshow', index).then((response) => {
        //     });
        // },
        // filterstates() {
        //     if (this.state.length == 0) {
        //         this.filteredStates = this.states;
        //     }
        //     this.filteredStates = this.states.filter(state => {
        //         return state.toLowerCase().startsWith(this.state.toLowerCase());
        //     });
        //     this.getkode(this.state)
        //     this.getmaxvalue(this.state)
        // },
        // setstate(state) {
        //     this.state = state;
        //     this.modal = false;
        // },
        // tambah() {
        //     axios.post('/api/admintambahspk', { nospk: this.state, stall: this.stall, kode: this.kode }).then((response) => {
        //         if (response.data.status == 400) {
        //             this.$swal({
        //                 title: 'pengisian SPK tidak Valid',
        //                 icon: 'error'
        //             });
        //         } else if (response.data.status == 401) {
        //             this.$swal({
        //                 title: 'SPK sudah dimasukkan ke list',
        //                 icon: 'error'
        //             });
        //         } else if (response.data.status == 200) {
        //             this.$swal({
        //                 title: 'sukses menambahkan ',
        //                 icon: 'sucess'
        //             });
        //             this.getdatatable();
        //         }
        //     });
        // },
        // cek() {
        //     if(this.datatable.length<=0){
        //         this.$swal({
        //             title: 'tidak ada SPK yang mau dicek, mohon input dulu',
        //             icon: 'error'
        //         });
        //     }
        //     else{
        //         axios.post('/api/konversikomponen').then((response) => {
        //         if (response.data.status == 200) {
        //             console.log(response.data)
        //             this.getdatatable()
        //             this.$router.push({
        //             name: 'Cekresult',
        //             params:{data:response.data.result}
        //              })
        //         }

        //     });
        //     }
        // },
        // getkode(state) {
        //     axios.post('/api/getkode', { maudikode: state }).then((response) => {
        //         if (response.data.status == 200) {
        //             this.kode = response.data.hasil
        //         } else if (response.data.status == 400) {
        //             this.kode = ''
        //         }
        //     });
        // },
        // getmaxvalue(state) {
        //     axios.post('/api/ambilmax', { kode: state }).then((response) => {
        //         if (response.data.status == 200) {
        //             this.max = response.data.hasil
        //             this.min = 1
        //             this.stall = 1
        //         } else if (response.data.status == 400) {
        //             this.max = 0
        //             this.min = 0
        //             this.stall = 0
        //         } else if (response.data.status == 401) {
        //             this.$swal({
        //                 title: 'SPK dengan Stall ini sudah terdaftar',
        //                 icon: 'error'
        //             });
        //         }
        //     });
    }
}
</script>
<style>

</style>
