<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <v-container style="z-index: 1;">
                <v-row dense>
                    <v-col cols="12" sm="6" md="3">
                        <span>NO SPK</span>
                        <v-autocomplete v-model="SPKfield" :items="listspk" class="form-control" required>
                        </v-autocomplete>
                        <div v-if="filteredStates && modal">
                            <ul style="width: 48em;	background-color: rgb(31 41 55); color: white;">
                                <li v-for="filteredstate in filteredStates" @click="setstate(filteredstate)"
                                    style="margin: 2hm;border-bottom: 2px black; cursor: pointer;">{{ filteredstate }}
                                </li>
                            </ul>
                        </div>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <span>Departemen</span>
                        <v-select :items="ListDept" item-text="text" item-value="value" v-model="Departemen" required
                            class="form-control" :disabled="disabledepartemen">
                        </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <span>Nama Stall</span>
                        <v-select :items="Liststall" item-text="Namastall" item-value="value" v-model="TempStall"
                            required class="form-control" return-object :disabled="disablenamastall">
                        </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <span>STALL</span>
                        <v-text-field class="form-control" :type="Changemode" :min="min" :max="max" v-model="stall"
                            :placeholder="Placeholdertext">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row dense>
                    <v-col cols="12" sm="6" md="5">
                        <button class="btn btn-primary" @click="tambah()"> TAMBAH</button>
                        <button class="btn" style="background-color: yellow;" @click="cek()">CEK</button>
                        <button class="btn" style="background-color: grey;"> INPUT SPK</button>
                        <button class="btn" style="background-color: cyan;"> HELP</button>
                        <button class="btn" style="background-color: greenyellow;"
                            @click="pindahhistory()">History</button>
                    </v-col>
                </v-row>
            </v-container>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>List Terdaftar</v-toolbar-title>
                        </v-toolbar>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="text-h5">Yakin Mau Menghapus Item ini ?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
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
import axios from 'axios'
import ConvertTime from '../../../Helper/ConvertTime'
export default {
    mixins: [ConvertTime],
    data() {
        return {
            listspk: [],
            datatable: [],
            filteredStates: [],
            SPKfield: "",
            Placeholdertext: "Masukkan Stall",
            Changemode: "number",
            disabledepartemen: false,
            disablenamastall: false,
            states: [],
            state: '',
            modal: false,
            Departemen: '',
            NamaStall: '',
            TempStall: '',
            Liststall: [],
            ListDept: [],
            stall: "",
            min: 0,
            max: 0,
            searchInput: "",
            dialogDelete: false,
            editedIndex: -1,
            headerstable: [
                {
                    text: 'Nomor SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NOSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Nama Stall', value: 'namastall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Stall', value: 'stall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Departemen', value: 'Departemen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Status', value: 'status', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Waktu Update Terakhir', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted() {
        this.getlistdepartemen()
        this.getlistspk()
        this.getdatatable()
    },
    watch: {
        state() {
            this.filterstates();
        },
        Departemen: function () {
            this.getliststall()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
        SPKfield: function () {
            if (this.SPKfield == "STOCK") {
                this.Changemode = "text"
                this.disabledepartemen = true
                this.disablenamastall = true
                this.Placeholdertext = "Masukkan Nama Stall"
                this.stall = ""
                this.NamaStall = "STOCK"
                this.Departemen = "STOCK"
            }
            else {
                this.stall = ""
                this.disabledepartemen = false
                this.disablenamastall = false
                this.Changemode = "number"
                this.Departemen = ""
                this.NamaStall = ""
            }
        },
        TempStall: function () {
            this.NamaStall = this.TempStall.Namastall
            this.max = this.TempStall.Jumlahstall
        }
    },
    methods: {
        changevalue(value) {
            this.ChangeStallmode = value
        },
        async getliststall() {
            await axios.post('/api/getlistallparameterinput', { Parameterdeps: this.Departemen }).then((response) => {
                console.log(response.data.result)
                this.Liststall = []
                this.Liststall = response.data.result
            })
        },
        async getlistdepartemen() {
            await axios.get('/api/listdepartemen').then((response) => {
                this.ListDept = response.data.data
            })
        },
        getlistspk() {
            axios.get('/api/listspkshow').then((response) => {
                this.listspk = []
                response.data.forEach(element => {
                    this.listspk.push({
                        'text': element.NOSPK,
                        'value': element.NOSPK
                    })
                });
                this.listspk.push({
                    'text': "STOCK",
                    'value': "STOCK"
                })
                // this.listspk = response.data
                // this.listspk.forEach(element => {
                //     this.states.push(element.NOSPK)
                // });
                this.filterstates();
            })
        },
        closeDelete() {
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
            axios.delete('/api/hapusdatatable' + datahapus["_id"]).then((response) => {
                if (response.data.status == 200) {
                    this.$swal({
                        title: 'Sukses Hapus Data',
                        icon: 'success'
                    });
                    this.getdatatable();
                } else if (response.data.status == 400) {
                    this.$swal({
                        title: 'Gagal Hapus Data',
                        icon: 'error'
                    });
                }
                console.log(response.data)
            })
            this.closeDelete()
        },
        async getdatatable() {
            await axios.get('/api/getdatatable').then((response) => {
                this.datatable = []
                this.datatable = response.data.reverse()
                this.datatable.forEach(element => {
                    element["updated_at"] = this.converttime(element["updated_at"])
                });
            })
        },
        pindahhistory() {
            this.$router.push({
                name: 'History'
            })
        },
        hapus(index) {
            axios.post('/api/hapusspkshow', index).then((response) => {
            });
        },
        filterstates() {
            if (this.state.length == 0) {
                this.filteredStates = this.states;
            }
            this.filteredStates = this.states.filter(state => {
                return state.toLowerCase().startsWith(this.state.toLowerCase());
            });
            // this.getkode(this.state)
            this.getmaxvalue(this.state)
        },
        setstate(state) {
            this.state = state;
            this.modal = false;
        },
        tambah() {
            if (this.SPKfield == "" || this.stall == "" || this.NamaStall == "" || this.Departemen == "") {
                this.$swal({
                    title: 'pengisian SPK tidak Valid',
                    icon: 'error'
                });
            }
            else {
                axios.post('/api/admintambahspk', { Nospk: this.SPKfield, Stall: this.stall, NamaStall: this.NamaStall, Departemen: this.Departemen }).then((response) => {
                    if (response.data.status == 400) {
                        this.$swal({
                            title: 'pengisian SPK tidak Valid',
                            icon: 'error'
                        });
                    } else if (response.data.status == 401) {
                        this.$swal({
                            title: 'SPK sudah dimasukkan ke list',
                            icon: 'error'
                        });
                    } else if (response.data.status == 200) {
                        this.$swal({
                            title: 'sukses menambahkan ',
                            icon: 'sucess'
                        });
                        this.getdatatable();
                    }
                });
            }
        },
        cek() {
            if (this.datatable.length <= 0) {
                this.$swal({
                    title: 'tidak ada SPK yang mau dicek, mohon input dulu',
                    icon: 'error'
                });
            }
            else {
                axios.post('/api/konversikomponen').then((response) => {
                    if (response.data.status == 200) {
                        console.log(response.data)
                        this.$router.push({
                            name: 'Cekresult',
                            params: { data: response.data }
                        })
                    }

                });
            }
        },
        // getkode(state) {
        //     axios.post('/api/getkode', { maudikode: state }).then((response) => {
        //         if (response.data.status == 200) {
        //             this.kode = response.data.hasil
        //         } else if (response.data.status == 400) {
        //             this.kode = ''
        //         }
        //     });
        // },
        getmaxvalue(state) {
            axios.post('/api/ambilmax', { kode: state }).then((response) => {
                if (response.data.status == 200) {
                    this.max = response.data.hasil
                    this.min = 1
                    this.stall = 1
                } else if (response.data.status == 400) {
                    this.max = 0
                    this.min = 0
                    this.stall = 0
                } else if (response.data.status == 401) {
                    this.$swal({
                        title: 'SPK dengan Stall ini sudah terdaftar',
                        icon: 'error'
                    });
                }
            });
        }
    }
}
</script>
<style>

</style>
