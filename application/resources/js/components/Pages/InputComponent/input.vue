<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <v-container style="z-index: 1;">
                <v-row dense >
                    <v-col cols="12" sm="6" md="3">
                        <span>NO SPK</span>
                        <v-text-field dense autocomplete="off" v-model="state" @focus="modal = true"
                            placeholder="Pilih nomor SPK" outlined>
                        </v-text-field>
                        <div v-if="filteredStates && modal">
                            <ul style="width: 48em;	background-color: rgb(31 41 55); color: white;">
                                <li v-for="filteredstate in filteredStates" @click="setstate(filteredstate)"
                                    style="margin: 2hm;border-bottom: 2px black; cursor: pointer;">{{ filteredstate }}
                                </li>
                            </ul>
                        </div>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <span>STALL</span>
                        <v-text-field dense type="number" v-model="stall" :max="max" :min="min"
                            placeholder="Masukkan Nomor Stall" outlined>
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="3">
                        <span>KODE</span>
                        <v-text-field dense type="text" v-model="kode" disabled outlined>
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
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="5"
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
import axios from 'axios';

export default {
    data() {
        return {
            listspk: [],
            datatable: [],
            filteredStates: [],
            states: [],
            state: '',
            modal: false,
            kode: '',
            max: 0,
            min: 0,
            stall: 0,
            dialogDelete: false,
            editedIndex: -1,
            headerstable: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NOSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Stall', value: 'stall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kode', value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Status', value: 'status', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Last Update', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted() {
        this.getlistspk();
        this.getdatatable();
    },
    watch: {
        state() {
            this.filterstates();
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },
    methods: {
        getlistspk() {
            axios.get('/api/listspkshow').then((response) => {
                this.listspk = []
                this.listspk = response.data
                this.listspk.forEach(element => {
                    this.states.push(element.NOSPK)
                });
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
            console.log(item["_id"])
            this.editedIndex = this.datatable.indexOf(item)
            console.log(this.editedIndex)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            var datahapus = this.datatable[this.editedIndex]
            console.log(datahapus["_id"])
            axios.delete('/api/hapusdatatable' + datahapus["_id"]).then((response) => {
                console.log(response.data)
            })
            // this.editedIndex = this.desserts.indexOf(item)
            // this.editedItem = Object.assign({}, item)
            // this.dialogDelete = true
            this.closeDelete()
        },
        async getdatatable() {
            await axios.get('/api/getdatatable').then((response) => {
                console.log(response.data)
                this.datatable = []
                this.datatable = response.data
                var i = 0;
            })
        },
        pindahhistory() {
            this.$router.push({
                name: 'History'
            })
        },
        hapus(index) {
            console.log(index);
            axios.post('/api/hapusspkshow', index).then((response) => {
                console.log(response.data);
            });
        },
        filterstates() {
            if (this.state.length == 0) {
                this.filteredStates = this.states;
            }
            this.filteredStates = this.states.filter(state => {
                return state.toLowerCase().startsWith(this.state.toLowerCase());
            });
            this.getkode(this.state)
            this.getmaxvalue(this.state)
        },
        setstate(state) {
            this.state = state;
            this.modal = false;
        },
        tambah() {
            axios.post('/api/admintambahspk', { nospk: this.state, stall: this.stall, kode: this.kode }).then((response) => {
                console.log(response.data);
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
        },
        cek() {
            this.$router.push({
                name: 'Cekresult'
            })
        },
        getkode(state) {
            axios.post('/api/getkode', { maudikode: state }).then((response) => {
                if (response.data.status == 200) {
                    this.kode = response.data.hasil
                } else if (response.data.status == 400) {
                    this.kode = ''
                }
            });
        },
        getmaxvalue(state) {
            axios.post('/api/ambilmax', { kode: state }).then((response) => {
                if (response.data.status == 200) {
                    console.log(response.data.hasil)
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
