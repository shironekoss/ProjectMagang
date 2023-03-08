<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30"
                    class="elevation-1 font-weight-bold" :footer-props="{
                        'items-per-page-options': [30, 50, 100, -1],
                        showFirstLastPage: true,
                        firstIcon: 'mdi-arrow-collapse-left',
                        lastIcon: 'mdi-arrow-collapse-right',
                        prevIcon: 'mdi-minus',
                        itemsPerPageText: 'foo',
                        pageText: 'bar'
                    }">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>History</v-toolbar-title>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-row dense v-if="item.series == 0">
                            <v-col cols="12" sm="6" md="5" style="float: left;">
                                <div style="display: flex;">
                                    <v-btn depressed color="orange" @click="pindahhistory(item)">Cek
                                        <font-awesome-icon icon="fa-solid fa-gears" style="margin-left: 5px;" />
                                    </v-btn>
                                    <v-btn depressed color="error" @click="deleteItem(item)"
                                        v-if="authStore.user.account_privileges.title == 'Super Admin Role'">Hapus
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
import ConvertTime from '../../../Helper/ConvertTime'
import Loading from '../../Global/Loading.vue'
import { useAuth } from '../../../../Stores/Auth';
import { useTimer } from '../../../../Stores/Timer';
export default {
    mixins: [ConvertTime],
    components: { Loading },
    setup() {
        const authStore = useAuth();
        const timerstore = useTimer();
        return { authStore, timerstore }
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
                { text: 'Nama Stall', value: 'namastall',sortable: false, class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Stall', value: 'stall',sortable: false, class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Departemen', value: 'Departemen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Status', value: 'status', sortable: false, width: '150px', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Waktu Update Terakhir',sortable: true, width: '250px', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions',sortable: false, width: '300px', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
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
    onIdle() {
        this.timerstore.LogoutTimers()
    },
    methods: {
        async getdatatable() {
            await axios.post('/api/getdatatablehistory', { Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept }).then((response) => {
                this.datatable = []
                var temp = response.data.reverse()
                var result = []
                temp.forEach(element => {
                    var time = this.converttime(element["updated_at"])
                    for (let index = 0; index <= Object.keys(element).length - 3; index++) {
                        result.push({
                            "NOSPK": element[index]["NOSPK"],
                            "namastall": element[index]["namastall"],
                            "stall": element[index]["stall"],
                            "Departemen": element[index]["Departemen"],
                            "status": element[index]["status"],
                            "updated_at": time,
                            "series": index,
                            "target": element["target"]
                        })
                    }
                });
                this.datatable = result
            })
        },
        async deleteItem(item) {
            await axios.post('/api/hapushistory', { Role: this.authStore.user.account_privileges.title, id: item.target }).then((response) => {
                if (response.data.status == 200) {
                    this.$swal({
                        title: "Sukses Menghapus",
                        icon: 'success'
                    });
                    this.getdatatable()
                }
            })
        },
        pindahhistory(item) {
            this.$router.push({
                name: 'CheckresultSingleHistory',
                params: {
                    name: item.NOSPK,
                    target: item.target,
                }
            })
        },
    }
}
</script>
<style></style>
