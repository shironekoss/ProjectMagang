<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>History</v-toolbar-title>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-row dense>
                            <v-col cols="12" sm="6" md="5" style="float: left;">
                                <div style="display: flex;">
                                    <v-btn depressed color="orange" @click="pindahhistory(item)">Cek
                                        <font-awesome-icon icon="fa-solid fa-gears" style="margin-left: 5px;" />
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
import ConvertTime from '../../../Helper/ConvertTime'
import Loading from '../../Global/Loading.vue'
import { useAuth } from '../../../../Stores/Auth';
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
        this.getdatatable()
    },
    watch: {
        state() {
            this.filterstates();
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
        async getdatatable() {
            await axios.post('/api/getdatatablehistory', {Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept}).then((response) => {
                this.datatable = []
                this.datatable = response.data.reverse()
                this.datatable.forEach(element => {
                    element["updated_at"] = this.converttime(element["updated_at"])
                });
            })
        },
        pindahhistory(item) {
            this.$router.push({
                name: 'CheckresultSingleHistory',
                params: { name: item.NOSPK,
                        data :item.kit}
            })
        },
    }
}
</script>
<style>

</style>
