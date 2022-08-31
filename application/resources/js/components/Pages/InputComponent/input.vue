<template>
    <div>
        <div class="col">
            <span>STALL</span>
            <input type="number" >
            <span>NO SPK</span>
            <input type="text" autocomplete="off" v-model="state" @input="filterstates">
            <div v-if="filteredStates">
                <ul style="width: 48em;	background-color: rgb(31 41 55); color: white;">
                    <li v-for="filteredstate in filteredStates" @click="setstate(filteredstate)" style="margin: 2hm;border-bottom: 2px black; cursor: pointer;">{{ filteredstate }}</li>
                </ul>
            </div>
            <span>KODE</span>
            <input type="text" disabled>
        </div>
        <br>
        <div style="margin-bottom: 20px;">
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
            filteredStates:[],
            states:[],
            state:''
            // selectItem: {},
        }
    },
    mounted() {
        this.getlistspk()
    },
    watch:{
        state(){
            this.filteredStates();
            getkode(this.state);
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
                console.log(this.listspkshow)
            })
        },
        filterstates(){
            this.filteredStates = this.states.filter(state => {
                return state.toLowerCase().startsWith(this.state.toLowerCase());
            });
        },
        setstate(state){
            this.state=state;
        },
        getkode(state){
            axios.post('/api/getkode', state).then((response) => {

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
