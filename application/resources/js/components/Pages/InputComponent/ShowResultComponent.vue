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
                { text: 'Kode Kit', value: 'kit', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Kit', value: 'kode', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Nama Komponen', value: 'status', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Kebutuhan', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Dari', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Ke', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
        }
    },
    mounted(){
        this.datatable = this.$route.params.data
        this.cetak()
    },
    methods:{
        cetak(){
            console.log(this.datatable)
        }
    }

}
</script>
<style>
</style>
