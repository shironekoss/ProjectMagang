<template>
    <div>
        <v-app>
            <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
            <div v-if="datatable">
                <v-data-table dense v-model="selected" @input="enterSelect()" :headers="headerstable" :items="datatable"
                    :items-per-page="10" class="elevation-1 font-weight-bold" :search="search" show-select
                    item-key="NOSPK">
                    <template v-slot:[`header.data-table-select`]></template>
                    <template v-slot:top>
                        <v-toolbar flat>
                            <v-toolbar-title>
                                <h5>List Terdaftar</h5>
                                <div>
                                    <v-text-field label="yang mau dikonversi" outlined v-model="selectedShowing"
                                        style="float: left;" disabled></v-text-field>
                                    <v-btn depressed color="blue" @click.prevent="checkfull()"
                                        style="float: right;margin-left: 15px; max-height: 61px; padding-left: 20px;">Show
                                        <font-awesome-icon icon="fa-solid fa-eye" />
                                    </v-btn>
                                </div>

                            </v-toolbar-title>
                        </v-toolbar>
                        <v-card-title>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                                hide-details>
                            </v-text-field>
                        </v-card-title>
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
export default {
    mixins: [ConvertTime],
    setup() {
        const authStore = useAuth();
        return { authStore }
    },
    data() {
        return {
            datatable: [],
            selected: [],
            selectedShowing: [],
            search: '',
            listspk: [],
            filteredStates: [],
            editedIndex: -1,
            headerstable: [
                { text: '', value: 'data-table-select' },
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
            ],
            errors: [],
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
    computed: {
        showingSelectedConvert() {
            this.selectedShowing = []
            this.selected.forEach(element => {
                this.selectedShowing.push(element.NOSPK)
            });
        }
    },
    methods: {
        changevalue(value) {
            this.ChangeStallmode = value
        },
        enterSelect() {
            // console.log(this.selected)
            this.showingSelectedConvert
        },
        handleClick(value) {
            console.log(value)
        },
        async getdatatable() {
            axios.post('/api/checkfull', { Role: this.authStore.user.account_privileges.title, Departemen: this.authStore.user.account_privileges.account_dept }).then((response) => {
                this.datatable = []
                this.datatable = response.data.reverse()
                this.datatable.forEach(element => {
                    element["updated_at"] = this.converttime(element["updated_at"])
                });
            })
        },
        checkfull() {
            if (this.selectedShowing.length == 0) {
                this.$swal({
                    icon: 'error',
                    title: "error",
                    text: 'Pilih lebih dahulu SPK yang mau di cek',
                    confirmButtonColor: '#FFFFFF',
                    confirmButtonText: ' <p style="color: #0a58ca;"> Why i have This Error ?</p> ',
                    showCloseButton: true,
                    focusConfirm: false,
                })
            }
            else{
                axios.post('/api/konversicheckfull', { NoSPK: this.selectedShowing }).then((response) => {
                this.errors = response.data.errors
                if (response.data.hasil <= 0) {
                    this.$swal({
                        icon: 'error',
                        title: "error",
                        text: 'Master ada yang salah atau master belum terdaftar',
                        confirmButtonColor: '#FFFFFF',
                        confirmButtonText: ' <p style="color: #0a58ca;"> Why i have This Error ?</p> ',
                        showCloseButton: true,
                        focusConfirm: false,
                    })
                        .then((result) => {
                            if (result.isConfirmed) {
                                var StringHTML = '<ul style="color: black;">'
                                this.errors.forEach(element => {
                                    console.log(element)
                                    StringHTML += '<li>' + element + '</li>'
                                });
                                StringHTML += '</ul>';
                                this.$swal.fire({
                                    title: '<strong><u>Alasan</u></strong>',
                                    icon: 'info',
                                    html: StringHTML,
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
            }
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
<style scoped>
.v-toolbar__title {
    font-size: 1.25rem;
    line-height: 1.5;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-bottom: auto;
    padding-top: 1%;
}

.v-card__title {
    align-items: center;
    display: flex;
    flex-wrap: wrap;
    font-size: 1.25rem;
    font-weight: 500;
    letter-spacing: 0.0125em;
    line-height: 2rem;
    word-break: break-all;
    padding-top: 3%;
}

.v-text-field {
    display: flex;
    flex: 1 1 auto;
    position: relative;
    min-width: 1000px;
}
</style>
