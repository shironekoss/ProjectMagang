<template>
    <div>
        <v-app>
            <v-card>
                <v-container class="grey lighten-5">
                    <v-row no-gutters>
                        <v-col sm="12" xs="12" md="12" lg="8" xl="6">
                            <v-card-title>
                                <div v-if="printable">
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Filter Site ID"
                                        single-line hide-details style="margin-right: 20px;">
                                    </v-text-field>
                                </div>
                                <div v-else>
                                    <v-text-field v-model="search" append-icon="mdi-magnify" label="filter kode kit"
                                        single-line hide-details style="margin-right: 20px;">
                                    </v-text-field>
                                </div>
                                <div v-if="printable">
                                    <JsonExcel class="btn btn-primary" :data="datatable" :fields="json_fields"
                                        worksheet="My Worksheet" name="filename.xls" style="margin-right: 20px;">
                                        Download Excel <font-awesome-icon icon="fa-solid fa-download" />
                                    </JsonExcel>
                                    <button class="btn btn-primary" @click="print">Print
                                        <font-awesome-icon icon="fa-solid fa-print" />
                                    </button>
                                    <button class="btn btn-primary" @click="triggermode"
                                        style="margin-left: 20px;">Check Admin
                                    </button>
                                </div>
                                <div v-else>
                                    <button class="btn btn-primary" @click="triggermode" style="margin-left: 20px;">Mode
                                        Semula
                                    </button>
                                </div>
                            </v-card-title>
                        </v-col>
                    </v-row>
                </v-container>
                <div v-if="printable">
                    <div id="printMe">
                        <div id="image"></div>
                        <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30"
                            :search="search" class="elevation-1 font-weight-bold">
                            <template v-slot:top>
                                <v-toolbar flat>
                                    <v-toolbar-title>List komponen</v-toolbar-title>
                                    <h5 class="tanggal">tanggal {{ new Date().toLocaleString() }}</h5>
                                </v-toolbar>
                            </template>
                        </v-data-table>
                    </div>
                </div>
                <div v-else>
                    <div id="image"></div>
                    <v-data-table dense :headers="headerstable2" :items="datatable2" :items-per-page="30" :search="search"
                        class="elevation-1 font-weight-bold">
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-toolbar-title>Daftar Kit</v-toolbar-title>
                                <h5 class="tanggal">tanggal {{ new Date().toLocaleString() }}</h5>
                            </v-toolbar>
                        </template>
                    </v-data-table>
                </div>

            </v-card>
        </v-app>
    </div>
</template>
<script>
import JsonExcel from "vue-json-excel"
import { useTimer } from '../../../../Stores/Timer';
import $ from 'jquery'
const options = {
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        '/css/print.css' // <- inject here
    ]
}
export default {
    components: { JsonExcel },
    setup() {
        const timerstore = useTimer();
        return { timerstore }
    },
    data() {
        return {
            output: null,
            waktu: "",
            printable:true,
            json_fields: {
                "NO SPK": "NoSPK",
                "Kode Kit": "kode",
                "Nama Kit": "namakit",
                "Nama Komponen": "namakomponen",
                "Kebutuhan": "Qty",
                "Siteid": "siteID",
                "Dari Rak": "Dari",
                "Ke Rak": "Kerak",
            },
            json_data: [
                {
                    name: "Tony Peña",
                    city: "New York",
                    country: "United States",
                    birthdate: "1978-03-15",
                    phone: {
                        mobile: "1-541-754-3010",
                        landline: "(541) 754-3010",
                    },
                },
                {
                    name: "Thessaloniki",
                    city: "Athens",
                    country: "Greece",
                    birthdate: "1987-11-23",
                    phone: {
                        mobile: "+1 855 275 5071",
                        landline: "(2741) 2621-244",
                    },
                },
            ],
            json_meta: [
                [
                    {
                        key: "charset",
                        value: "utf-8",
                    },
                ],
            ],
            search: '',
            datatable: [],
            headerstable2: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NoSPK',
                    filterable: false,
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Kode Kit', filterable: true, value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', filterable: false, value: 'namakit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            headerstable: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NoSPK',
                    filterable: false,
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Kode Kit', filterable: false, value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', filterable: false, value: 'namakit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kode Komponen', filterable: false, value: 'kodekomponen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Komponen', filterable: false, value: 'namakomponen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kebutuhan', filterable: false, value: 'Qty', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Siteid', value: 'siteID', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Dari Rak', filterable: false, value: 'Dari', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Ke Rak', filterable: false, value: 'Kerak', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted() {
        this.datatable = this.$route.params.data.hasil
        this.datatable2 = this.$route.params.data.hasil
        this.datatable = this.konversi(this.datatable)
        this.datatable2 = this.konversi2(this.datatable2)
        this.waktu = this.waktusekarang()
    },
    onIdle() {
        this.timerstore.LogoutTimers()
    },
    methods: {
        triggermode(){
            this.printable=!this.printable
        },
        konversi(array) {
            console.log(array)
            let newdata = [];
            array.forEach(SPK => {
                SPK["kit"].forEach(kits => {
                    kits.forEach(komponen => {
                        komponen["IsiKit"].forEach(subkomponen => {
                            let obj = {};
                            obj['NoSPK'] = SPK.NoSPK;
                            obj['kode'] = komponen.Kodekit;
                            obj['namakit'] = komponen.NamaKit;
                            obj['kodekomponen'] = subkomponen.kode_komponen;
                            obj['namakomponen'] = subkomponen.nama_komponen;
                            obj['Qty'] = parseInt(subkomponen.qty);
                            obj['siteID'] = komponen.siteID;
                            obj['Dari'] = subkomponen.darirak;
                            obj['Kerak'] = subkomponen.kerak;
                            newdata.push(obj);
                        });

                    });
                });
            });
            console.log(newdata)
            return newdata;
        },
        konversi2(array) {
            console.log(array)
            let newdata = [];
            array.forEach(SPK => {
                SPK["kit"].forEach(kits => {
                    kits.forEach(komponen => {
                            let obj = {};
                            obj['NoSPK'] = SPK.NoSPK;
                            obj['kode'] = komponen.Kodekit;
                            obj['namakit'] = komponen.NamaKit;
                            newdata.push(obj);
                    });
                });
            });
            console.log(newdata)
            return newdata;
        },
        async print() {
            // Pass the element id here
            $("#image").append(`<img src='/images/Logo_Adi_Putro.svg' alt='' srcset=''>`)
            $(".v-data-footer__select").html('')
            $(".v-data-footer__pagination").html('')
            $(".v-data-footer__icons-before").html('')
            $(".v-data-footer__icons-after").html('')
            await this.$htmlToPaper('printMe', options);
            $("#image").html(``);
        },
        async waktusekarang() {
            let today = new Date()
            let dd = String(today.getDate()).padStart(2, '0')
            let mm = String(today.getMonth() + 1).padStart(2, '0')//January is 0!
            let yyyy = today.getFullYear()
            today = mm + '/' + dd + '/' + yyyy;
            return today
        }
    }
}
</script>
<style scoped>
@media print {
    @page {
        size: landscape,
    }
}

.tanggal {
    margin-left: 500px;
}
</style>
