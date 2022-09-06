<template>
    <div>
        <h1>disini Result Component nanti</h1>
        <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10"
            class="elevation-1 font-weight-bold">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>List daftar komponen</v-toolbar-title>
                </v-toolbar>
            </template>
        </v-data-table>
    </div>
</template>
<script>
export default{
    data(){
        return{
        datatable:[],
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
                { text: 'Dari', value: 'Dari', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Ke', value: 'Kerak', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted(){
        this.datatable = this.$route.params.data
        this.datatable=this.konversi(this.datatable)
    },
    methods:{
        konversi(array){
            console.log(array)
            let newdata=[];
            array.forEach(SPK => {
                SPK["kit"].forEach(kits => {
                    kits["result"].forEach(komponen => {
                    let obj ={};
                    obj['NoSPK'] = SPK.NoSPK;
                    // obj['kode'] = array.NoSPK;
                    obj['namakit'] = kits.namakit;
                    obj['namakomponen'] = komponen.nama_komponen;
                    obj['Qty'] = komponen.qty;
                    obj['Dari'] = komponen.darirak;
                    obj['Kerak'] = komponen.kerak;
                    newdata.push(obj);
                    });
                });
            });
            return newdata;
        }
    }
}
</script>
<style>
</style>
