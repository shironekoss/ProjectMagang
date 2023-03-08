<template>
    <div>
        <v-app>
            <v-card>
                <v-container class="grey lighten-5">
                    <v-row no-gutters>
                        <v-col sm="12" xs="12" md="12" lg="8" xl="6">
                            <v-card-title>
                                <v-text-field v-model="search" append-icon="mdi-magnify" label="Filter Site ID" single-line
                                    hide-details style="margin-right: 20px;">
                                </v-text-field>
                                <JsonExcel class="btn btn-primary" :data="datatable" :fields="json_fields"
                                    worksheet="My Worksheet" name="filename.xls" style="margin-right: 20px;">
                                    Download Excel <font-awesome-icon icon="fa-solid fa-download" />
                                </JsonExcel>
                                <button class="btn btn-primary" @click="print">Print
                                    <font-awesome-icon icon="fa-solid fa-print" />
                                </button>
                            </v-card-title>
                        </v-col>
                    </v-row>
                </v-container>
                <div id="printMe">
                    <div id="image"></div>
                    <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30" :search="search"
                        class="elevation-1 font-weight-bold" :footer-props="{
                            'items-per-page-options': [30, 50, 100, -1],
                            showFirstLastPage: true,
                            firstIcon: 'mdi-arrow-collapse-left',
                            lastIcon: 'mdi-arrow-collapse-right',
                            prevIcon: 'mdi-minus',
                            itemsPerPageText: 'Tampilkan',
                            pageText: 'bar'
                        }">
                        <template v-slot:top>
                            <v-toolbar flat>
                                <v-toolbar-title>List komponen</v-toolbar-title>
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
import $ from 'jquery'
import { useTimer } from '../../../../Stores/Timer';
const options = {
    styles: [
        // 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
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
            json_fields: {
                "NO SPK": "NoSPK",
                "Kode Kit": "kode",
                "Nama Kit": "nama_komponen",
                "Nama Komponen": "nama_komponen",
                "Kebutuhan": "kebutuhan",
                "Tersedia": "available",
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
            headerstable: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NoSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Cek ke', filterable: false, value: 'count', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kode Kit', filterable: false, value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', filterable: false, value: 'namakit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kode Komponen', filterable: false, value: 'kode_komponen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Komponen', filterable: false, value: 'nama_komponen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kebutuhan', filterable: false, value: 'kebutuhan', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Tersedia', filterable: false, value: 'available', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Siteid', value: 'siteID', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Dari Rak', filterable: false, value: 'Dari', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Ke Rak', filterable: false, value: 'Kerak', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    onIdle() {
        this.timerstore.LogoutTimers()
    },
    mounted() {
        let temp = this.$route.params.hasil
        this.datatable = this.konversi(temp)
        this.waktu = this.waktusekarang()
    },
    methods: {
        konversi(arraysset) {
            let newdata = [];
            arraysset.forEach(arrays => {
                arrays.forEach(array => {
                    array.kit.forEach(Kits => {
                        Kits.forEach(Kit => {
                            Kit["IsiKit"].forEach(Komponen => {
                                let obj = []
                                obj['NoSPK'] = array["NoSPK"];
                                obj['count'] = array["count"];
                                obj['kode'] = Kit["Kodekit"];
                                obj['namakit'] = Kit["NamaKit"];
                                obj['siteID'] = Kit["siteID"];
                                obj['kode_komponen'] = Komponen["kode_komponen"];
                                obj['nama_komponen'] = Komponen["nama_komponen"];
                                obj['Satuan'] = Komponen["Satuan"];
                                obj['kebutuhan'] = parseInt(Komponen["qty"]);
                                obj['available'] = parseInt(Komponen["Qty_Available"]);
                                newdata.push(obj);
                            })
                        })
                    })
                });
            });
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
