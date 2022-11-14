<template>
    <div>
        <v-app>
            <v-card>
                <v-container class="grey lighten-5">
                    <v-row no-gutters>
                        <v-col sm="12" xs="12" md="12" lg="8" xl="6">
                            <v-card-title >
                                <v-text-field v-model="search" append-icon="mdi-magnify" label="Filter Site ID"
                                    single-line hide-details style="margin-right: 20px;">
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
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30" :search="search"
                    id="printMe" class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>List daftar komponen</v-toolbar-title>
                            <h5 style="margin-left: 70%;">{{ new Date().toLocaleString() }}</h5>
                        </v-toolbar>
                    </template>
                </v-data-table>
            </v-card>
        </v-app>
    </div>
</template>
<script>
import JsonExcel from "vue-json-excel"
const options = {
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        './print.css' // <- inject here
    ]
}
export default {
    components: { JsonExcel },
    data() {
        return {
            output: null,
            waktu: "",
            json_fields: {
                "NO SPK": "kode",
                "Kode Kit": "namakit",
                "Nama Kit": "namakomponen",
                "Nama Komponen": "Qty",
                "Kebutuhan": "name",
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
                    filterable: false,
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Kode Kit', filterable: false, value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', filterable: false, value: 'namakit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
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
        this.datatable = this.konversi(this.datatable)
        this.waktu = this.waktusekarang()
    },
    methods: {
        konversi(array) {
            console.log(array[0]["kit"][0])
            let newdata = [];
            array.forEach(SPK => {
                SPK["kit"].forEach(kits => {
                    kits.forEach(komponen => {
                        komponen["IsiKit"].forEach(subkomponen => {
                            let obj = {};
                            obj['NoSPK'] = SPK.NoSPK;
                            obj['kode'] = komponen.Kodekit;
                            obj['namakit'] = komponen.NamaKit;
                            obj['namakomponen'] = subkomponen.nama_komponen;
                            obj['Qty'] = subkomponen.qty;
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
        async print() {
            // Pass the element id here
            await this.$htmlToPaper('printMe', options);
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
</style>
