<template>
    <div>
        <div style=" position: absolute; inset: 0; z-index: 0;" @click="modal = false"></div>
        <div class="col" style="z-index: 1;position: relative;">
            <span>NO SPK</span>
            <input type="text" autocomplete="off" v-model="state" @focus="modal = true">
            <div v-if="filteredStates && modal">
                <ul style="width: 48em;	background-color: rgb(31 41 55); color: white;">
                    <li v-for="filteredstate in filteredStates" @click="setstate(filteredstate)"
                        style="margin: 2hm;border-bottom: 2px black; cursor: pointer;">{{ filteredstate }}</li>
                </ul>
            </div>
            <span>STALL</span>
            <input type="number" v-model="stall" :max="max" :min="min">
            <span>KODE</span>
            <input type="text" v-model="kode" disabled>
        </div>
        <br>
        <div style="margin-bottom: 20px; z-index: 1;position: relative">
            <button class="btn btn-primary" @click="tambah()"> TAMBAH</button>
            <button class="btn" style="background-color: yellow;" @click="cek()">CEK</button>
            <button class="btn" style="background-color: grey;"> INPUT SPK</button>
            <button class="btn" style="background-color: cyan;"> HELP</button>
            <button class="btn" style="background-color: greenyellow;" @click="pindahhistory()">History</button>
        </div>
        <div v-if="datatable">
            <v-app>
                <v-data-table dense :headers="headerstable" :items="datatable" :items-per-page="5" class="elevation-1 font-weight-bold">

                </v-data-table>
            </v-app>

        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            listspk: [],
            datatable: [],
            filteredStates: [],
            states: [],
            state: '',
            modal: false,
            kode: '',
            max: 0,
            min: 0,
            stall: 0,
            table: null,
            headerstable: [
                {
                    text: 'NO SPK',
                    align: 'start',
                    sortable: false,
                    value: 'NOSPK',
                    class: "title text-uppercase font-weight-black black--text light-blue lighten-5"
                },
                { text: 'Stall', value: 'stall', class: "title text-uppercase font-weight-black black--text light-blue lighten-5"},
                { text: 'Kode', value: 'kode'  ,class: "title text-uppercase font-weight-black black--text light-blue lighten-5"},
                { text: 'Status', value: 'status',class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Last Update', value: 'updated_at',class: "title text-uppercase font-weight-black black--text light-blue lighten-5" },
                { text: 'Action', value: 'iron',class: "title text-uppercase font-weight-black black--text light-blue lighten-5"},
            ],
        }
    },
    mounted() {
        this.getlistspk();
        this.getdatatable();
    },
    watch: {
        state() {
            this.filterstates();
        }
    },
    methods: {
        getlistspk() {
            axios.get('/api/listspkshow').then((response) => {
                this.listspk = []
                this.listspk = response.data
                this.listspk.forEach(element => {
                    this.states.push(element.NOSPK)
                });
                this.filterstates();
            })
        },
        async getdatatable() {
            await axios.get('/api/getdatatable').then((response) => {
                console.log(response.data)
                this.datatable = []
                this.datatable = response.data
                var i = 0;
            })
        },
        pindahhistory() {
            this.$router.push({
                name: 'History'
            })
        },
        hapus(index) {
            console.log(index);
            axios.post('/api/hapusspkshow', index).then((response) => {
                console.log(response.data);
            });
        },
        filterstates() {
            if (this.state.length == 0) {
                this.filteredStates = this.states;
            }
            this.filteredStates = this.states.filter(state => {
                return state.toLowerCase().startsWith(this.state.toLowerCase());
            });
            this.getkode(this.state)
            this.getmaxvalue(this.state)
        },
        setstate(state) {
            this.state = state;
            this.modal = false;
        },
        tambah() {
            axios.post('/api/admintambahspk', { nospk: this.state, stall: this.stall, kode: this.kode }).then((response) => {
                console.log(response.data);
                if (response.data.status == 400) {
                    this.$swal({
                        title: 'pengisian SPK tidak Valid',
                        icon: 'error'
                    });
                } else if (response.data.status == 401) {
                    this.$swal({
                        title: 'SPK sudah dimasukkan ke list',
                        icon: 'error'
                    });
                } else if (response.data.status == 200) {
                    this.$swal({
                        title: 'sukses menambahkan ',
                        icon: 'sucess'
                    });
                    this.getdatatable();
                }
            });
        },
        cek() {
            this.$router.push({
                name: 'Cekresult'
            })
        },
        getkode(state) {
            axios.post('/api/getkode', { maudikode: state }).then((response) => {
                if (response.data.status == 200) {
                    this.kode = response.data.hasil
                } else if (response.data.status == 400) {
                    this.kode = ''
                }
            });
        },
        getmaxvalue(state) {
            axios.post('/api/ambilmax', { kode: state }).then((response) => {
                if (response.data.status == 200) {
                    console.log(response.data.hasil)
                    this.max = response.data.hasil
                    this.min = 1
                    this.stall = 1
                } else if (response.data.status == 400) {
                    this.max = 0
                    this.min = 0
                    this.stall = 0
                } else if (response.data.status == 401) {
                    this.$swal({
                        title: 'SPK dengan Stall ini sudah terdaftar',
                        icon: 'error'
                    });
                }
            });
        }
    }
}
</script>
<style>
</style>
