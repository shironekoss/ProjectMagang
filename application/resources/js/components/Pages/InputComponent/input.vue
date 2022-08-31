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
            <button class="btn btn-primary"> TAMBAH</button>
            <button class="btn" style="background-color: yellow;"> CEK</button>
            <button class="btn btn-danger"> HAPUS</button>
            <button class="btn" style="background-color: grey;"> INPUT SPK</button>
            <button class="btn" style="background-color: cyan;"> HELP</button>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            listspk: [],
            filteredStates: [],
            states: [],
            state: '',
            modal: false,
            kode: '',
            max: 0,
            min:0,
            stall:0,
            // selectItem: {},
        }
    },
    mounted() {
        this.getlistspk();

    },
    watch: {
        state() {
            this.filterstates();

        }
    },

    // computed: {
    //     getId: function () {
    //         alert(this.$ref.frmCompanyInput.id);
    //     },
    //     getValue: function () {
    //         alert(this.$ref.frmCompanyInput.value);
    //     }
    // },
    methods: {
        getlistspk() {
            axios.get('/api/listspkshow').then((response) => {
                this.listspk = response.data
                this.listspk.forEach(element => {
                    this.states.push(element.NOSPK)
                });
                this.filterstates();
            })
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
                    this.stall=1
                } else if (response.data.status == 400) {
                    this.max = 0
                    this.min = 0
                    this.stall=0
                }

            });
        }

        // selectItem(item) {
        //     this.selectItem = item;
        // }
    }
}
</script>


<style>
</style>
