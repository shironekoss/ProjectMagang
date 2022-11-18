<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <div v-if="datatable">
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="10"
                    class="elevation-1 font-weight-bold">
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>List Terdaftar</v-toolbar-title>
                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-btn depressed color="blue" @click.prevent="checkfull(item)">Show
                            <font-awesome-icon icon="fa-solid fa-eye" style="margin-left: 5px;" />
                        </v-btn>
                    </template>
                </v-data-table>
            </div>
        </v-app>
    </div>

</template>


<script>
import axios from 'axios'
import ConvertTime from '../../../Helper/ConvertTime'
export default {
    mixins: [ConvertTime],
    data() {
        return {
            datatable: [],
            listspk: [],
            filteredStates: [],
            editedIndex: -1,
            headerstable: [
                {
                    text: 'Nomor SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NOSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Model Mobil', value: 'parameter.ModelMobil', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Tinggi Mobil', value: 'parameter.TinggiMobil', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Tipe Mobil', value: 'parameter.TipeMobil', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Waktu Update Terakhir', value: 'updated_at', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'actions', class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
            ],
            errors:[],
        }
    },
    mounted() {
        this.getdatatable()
    },
    watch: {
        state() {
            this.filterstates();
        },
    },
    methods: {
        changevalue(value) {
            this.ChangeStallmode = value
        },
        async getdatatable() {
            axios.get('/api/listspkshow').then((response) => {
                this.datatable = []
                this.datatable = response.data.reverse()
                this.datatable.forEach(element => {
                    element["updated_at"] = this.converttime(element["updated_at"])
                });
            })
        },
        checkfull(item) {
            axios.post('/api/konversisinglespk', { NoSPK: item.NOSPK }).then((response) => {
                this.errors = response.data.errors
                if (response.data.hasil == 0) {
                    this.$swal({
                        icon: 'error',
                        title: "error",
                        text: 'Master ada yang salah',
                        confirmButtonColor: '#FFFFFF',
                        confirmButtonText: ' <p style="color: #0a58ca;"> Why i have This Error ?</p> ',
                        showCloseButton: true,
                        focusConfirm: false,
                    })
                        .then((result) => {
                            if (result.isConfirmed) {
                                var StringHTML = '<ul style="color: black;">'
                                this.errors.forEach(element=>{
                                    console.log(element)
                                    StringHTML += '<li>'+element +'</li>'
                                });
                                StringHTML += '</ul>';
                                this.$swal.fire({
                                    title: '<strong><u>Alasan</u></strong>',
                                    icon: 'info',
                                    html:StringHTML,
                                    showCloseButton: true,
                                    showCancelButton: true,
                                    focusConfirm: false,
                                })
                            }
                        });
                } else {
                    this.$router.push({
                        name: 'CheckFullDetail',
                        params: { hasil: response.data.hasil }
                    })
                }
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
    }
}
</script>
<style>

</style>
