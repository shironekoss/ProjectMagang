<template>
    <div>
        <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="30"
            class="elevation-1 font-weight-bold">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>List daftar komponen</v-toolbar-title>
                    <JsonExcel class="btn btn-default" :data="datatable" :fields="json_fields"
                        worksheet="My Worksheet" name="filename.xls">
                        Download Excel (you can customize this with html code!)
                    </JsonExcel>
                </v-toolbar>
            </template>
        </v-data-table>
    </div>
</template>
<script>
import JsonExcel from "vue-json-excel";
export default {
    components: { JsonExcel },
    data() {
        return {
            // json_fields: {
            //     "Complete name": "name",
            //     City: "city",
            //     Telephone: "phone.mobile",
            //     "Telephone 2": {
            //         field: "phone.landline",
            //         callback: (value) => {
            //             return `Landline Phone - ${value}`;
            //         },
            //     },
            // },
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
            datatable: [],
            headerstable: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NoSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Kode Kit', value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', value: 'namakit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Komponen', value: 'namakomponen', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kebutuhan', value: 'Qty', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Siteid', value: 'siteID', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Dari Rak', value: 'Dari', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Ke Rak', value: 'Kerak', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted() {
        this.datatable = this.$route.params.data.hasil
        this.datatable = this.konversi(this.datatable)
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
        }
    }
}
</script>
<style>

</style>
