<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <v-container style="z-index: 1;">
                <!-- <v-progress-circular indeterminate color="primary"></v-progress-circular> -->
                <v-row>
                    <v-col cols="12" sm="6" md="3">
                        <v-btn depressed color="primary" @click.prevent="tarikdataspk"> Tarik data SPK
                            <font-awesome-icon icon="fa-solid fa-database" style="margin-left: 15px;" />
                        </v-btn>
                    </v-col>
                </v-row>
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
                            :placeholder="Placeholdertext" @keypress="preventNumericInput">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row dense>
                    <v-col cols="12" sm="6" md="5">
                        <button class="btn btn-primary" @click="tambah()"> TAMBAH
                            <font-awesome-icon icon="fa-solid fa-plus" style="margin-left: 5px;" />
                        </button>
                        <button class="btn" style="background-color: yellow;" @click="cek()">CEK
                            <font-awesome-icon icon="fa-solid fa-gears" style="margin-left: 5px;" />
                        </button>
                        <button class="btn" style="background-color: greenyellow;" @click="pindahhistory()">History
                            <font-awesome-icon icon="fa-solid fa-clock-rotate-left" style="margin-left: 5px;" />
                        </button>
                    </v-col>
                </v-row>
            </v-container>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30"
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
                        <v-dialog v-model="dialogErrors" max-width="500px">
                            <v-card>
                                <v-toolbar color="primary" dark class="text-lg-h5">Alasan Pending</v-toolbar>
                                <ol>
                                    <v-card-text>
                                        <li v-for="(message, index) in errormessage" :key="index"
                                            class="font-weight-black text-lg-h6">{{ message }}</li>

                                    </v-card-text>
                                </ol>
                                <hr>
                                <v-card-actions>
                                    <v-btn outlined color="black" style="background-color:rgba(125, 241, 230, 0.8) ;"
                                        text @click="closeErrors">Cancel</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialogLoading" max-width="500px">
                            <Loading />
                        </v-dialog>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-row dense>
                            <v-col cols="12" sm="6" md="5" style="float: left;">
                                <div style="display: flex;">
                                    <div v-if="showerror(item)">
                                        <v-btn depressed color="warning" @click="errors(item)"
                                            style="margin-right: 10px;">problem? </v-btn>
                                    </div>
                                    <v-btn depressed color="error" @click="deleteItem(item)">Hapus
                                        <font-awesome-icon icon="fa-solid fa-trash" style="margin-left: 5px;" />
                                    </v-btn>
                                </div>
                            </v-col>
                        </v-row>
                    </template>
                </v-data-table>
            </div>
        </v-app>
    </div>
</template>

<script>
import axios from 'axios'
import { useAuth } from '../../../../Stores/Auth';
import ConvertTime from '../../../Helper/ConvertTime'
import Loading from '../../Global/Loading.vue'
export default {
    mixins: [ConvertTime],
    components: { Loading },
    setup() {
        const authStore = useAuth();
        return { authStore }
    },
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
            dialogErrors: false,
            dialogLoading: false,
            editedIndex: -1,
            errormessage: [],
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
                { text: 'Status', value: 'status', width: '150px', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Waktu Update Terakhir', width: '250px', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', width: '300px', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
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
        dialogErrors(val) {
            val || this.closeErrors()
        },
        dialogLoading(val) {
            val || this.closeLoading()
        },
        SPKfield: function () {
            if (this.SPKfield == "STOCK") {
                this.Changemode = "text"
                this.disablenamastall = true
                this.Placeholdertext = "Masukkan Nama Stall"
                this.stall = ""
                this.NamaStall = "STOCK"
            }
            else {
                this.stall = ""
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
        preventNumericInput($event) {
            console.log($event.keyCode); //will display the keyCode value

            var keyCode = ($event.keyCode ? $event.keyCode : $event.which);
            if (keyCode > 47 && keyCode < 58) {
                $event.preventDefault();
            }
        },
        showerror(item) {
            if (!item.errors) {
                return false
            } else {
                return item.errors.length == 0 ? false : true
            }

        },
        async tarikdataspk() {
            this.openDialogLoading()
            await axios.post('/api/getdataspk').then((response) => {
                console.log(response.data)
                if (response.data.statusresponse == 200) {
                    this.closeLoading()
                    this.$swal({
                        title: response.data.message,
                        icon: 'success'
                    });
                }
                else if (response.data.statusresponse == 400) {
                    this.closeLoading()
                    this.$swal({
                        title: response.data.message,
                        icon: 'error'
                    });
                }
            })
            this.getlistspk();
        },
        async getliststall() {
            await axios.post('/api/getlistallparameterinput', { Parameterdeps: this.Departemen }).then((response) => {
                console.log(response.data.result)
                this.Liststall = []
                this.Liststall = response.data.result
            })

        },
        async getlistdepartemen() {
            await axios.post('/api/listdepartemen', { Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept }).then((response) => {
                this.ListDept = response.data.data
            })
        },
        getlistspk() {
            axios.post('/api/listspkshow', { Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept }).then((response) => {
                this.listspk = []
                response.data.forEach(element => {
                    this.listspk.push({
                        'text': element,
                        'value': element
                    })
                });
                this.listspk.push({
                    'text': "STOCK",
                    'value': "STOCK"
                })
                this.filterstates();
            })
        },
        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedIndex = -1
            })
        },
        closeErrors() {
            this.dialogErrors = false
            this.$nextTick(() => {
                this.errormessage = []
            })
        },
        closeLoading() {
            this.dialogLoading = false;
        },
        deleteItem(item) {
            this.editedIndex = this.datatable.indexOf(item)
            this.dialogDelete = true
        },
        openDialogLoading() {
            this.dialogLoading = true
        },
        errors(item) {
            this.errormessage = item.errors
            this.dialogErrors = true
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
            await axios.post('/api/getdatatable',{Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept}).then((response) => {
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
            if (this.SPKfield == "" || this.stall == "" || this.stall == 0 || this.NamaStall == ""  || this.Departemen == "") {
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
                        this.$router.push({
                            name: 'Cekresult',
                            params: { data: response.data }
                        })
                    }

                });
            }
        },
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
