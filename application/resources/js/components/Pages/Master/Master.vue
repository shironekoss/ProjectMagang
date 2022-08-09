<template>
    <div>

        <div class="row">
            <div class="col-6" style="float: left;">
                <div class="row">
                    <div class="col">Kode Mobil</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.kodemobil">
                    </div>
                </div>
                <div class="row">
                    <div class="col">Model Bagasi</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modelbagasi[0]">
                        <button type="button" @click="add('modelbagasi')" class="btn btn-primary">Tambah</button>
                        <button type="button" @click="remove('modelbagasi')" class="btn btn-danger">hapus
                            tambahan</button>
                        <div v-for="(component, index) in componentsbagasi" :key="index" :id=index tipe="modelbagasi">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modelbagasi[index + 1]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Model Pintu</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modelpintu[0]">
                        <button type="button" @click="add('modelpintu')" class="btn btn-primary">Tambah</button>
                        <button type="button" @click="remove('modelpintu')" class="btn btn-danger">hapus
                            tambahan</button>
                        <component v-for="(component, index) in componentspintu" :key="index" :id=index
                            tipe="modelpintu">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modelpintu[index + 1]" required>
                            </div>
                        </component>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Bangku</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modelbangku[0]">
                        <button type="button" @click="add('modelbangku')" class="btn btn-primary ">Tambah</button>
                        <button type="button" @click="remove('modelbangku')" class="btn btn-danger">hapus
                            tambahan</button>
                        <div v-for="(component, index) in componentsbangku" :key="index" :id=index tipe="modelbangku">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modelbangku[index + 1]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Model Body</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modelbody[0]">
                        <button type="button" @click="add('modelbody')" class="btn btn-primary">Tambah</button>
                        <button type="button" @click="remove('modelbody')" class="btn btn-danger">hapus
                            tambahan</button>
                        <div v-for="(component, index) in componentsbody" :key="index" :id=index tipe="modelbody">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modelbody[index + 1]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Model Trap Tangga</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modeltangga[0]">
                        <button type="button" @click="add('modeltraptangga')" class="btn btn-primary">Tambah</button>
                        <button type="button" @click="remove('modeltraptangga')" class="btn btn-danger">hapus
                            tambahan</button>
                        <div v-for="(component, index) in componentstraptangga" :key="index" :id=index
                            tipe="modeltraptangga">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modeltangga[index + 1]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" row">
                    <div class="col">Lampu Belakang</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modellampubelakang[0]">
                        <button type="button" @click="add('modellampubelakang')" class="btn btn-primary">Tambah</button>
                        <button type="button" @click="remove('modellampubelakang')" class="btn btn-danger">hapus
                            tambahan</button>
                        <div v-for="(component, index) in componentlampubelakang" :key="index" :id=index
                            tipe="modellampubelakang">
                            <div class="col-10">
                                <input type="text" v-model="parameter.modellampubelakang[index + 1]" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">Stall</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.stall">
                    </div>
                </div>
                <div class="row">
                    <div class="col">Kode Kit</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.kodekit">
                    </div>
                </div>
                <hr>
                <h3>Additional Parameter</h3>
                <button type="button" @click="Tambahkomponen()" class="btn btn-primary">Tambah Parameter</button>
                <button type="button" @click="hapuskomponen()" class="btn btn-primary">Hapus Komponen</button>
                <div v-for="(component, index) in parameter.newparameter" :key="index" :id=index>
                    <div class="row">
                        <div class="col">
                            <input type="text" v-model="parameter.newparameter[index].newparam">
                        </div>
                        <div class="col-10">
                            <input type="text" v-model="parameter.newparameter[index].components[0]">
                            <button type="button" @click="addnewcomponent(index)"
                                class="btn btn-primary">Tambah</button>
                            <button type="button" @click="removenewcomponen(index)" class="btn btn-danger">hapus
                                tambahan</button>
                            <div v-for="(component2, index2) in componentsnewparameter[index].components" :key="index2"
                                :id=index2>
                                <div class="col-10">
                                    <input type="text" v-model="parameter.newparameter[index].components[index2 + 1]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6" style=" float: right;">
                <div class="row">
                    <div class="col">Nama Kit</div>
                    <div class="col-10">
                        <input type="text" v-model="kit.namakit">
                    </div>
                </div>
                <button type="button" @click="tambahresultkomponen()" class="btn btn-primary">Tambah
                    Komponen</button><br>
                <!-- <button type="button" @click="hapusresultkomponen()" class="btn btn-danger">Hapus Komponen</button><br> -->
                <div v-for="(component, index) in kit.result" :key="index" :id=index>
                    <div class="row">
                        <div class="col">Nama Komponen
                            <input type="text" v-model="kit.result[index].namakomponen">
                            QTY : <input type="number" v-model="kit.result[index].qty">
                            dari Rak : <input type="number" v-model="kit.result[index].darirak">
                            ke rak : <input type="number" v-model="kit.result[index].kerak">
                        </div>
                    </div>
                </div>
            </div>
            <form @submit.prevent="generate">
                <div class="row">
                    <center>
                        <button type="submit" class="btn btn-success"> generate</button>
                    </center>
                </div>
            </form>
            <form @submit.prevent="handleSubmit">
                <div class="row">
                    <center>
                        <button type="submit" class="btn btn-success"> Simpan</button>
                    </center>
                </div>
            </form>
        </div>

    </div>


</template>

<style scoped>
.row {
    margin-bottom: 15px;
}

.panel {
    flex: 5;
    height: 100vh;
    overflow: scroll;

}
</style>

<script>
const Componentnewfield = {
    props: {
        id: Number,
        tipe: String,
    },
    data() {
        return {
            value: "",
        }
    },
    template: ` <div class="col-10">
                    <input type="text">
                </div>`,
    methods: {

    }
}

export default {
    data() {
        return {
            componentsbagasi: [],
            componentspintu: [],
            componentsbangku: [],
            componentsbody: [],
            componentstraptangga: [],
            componentlampubelakang: [],
            componentsnewparameter: [],
            parameter: {
                kodemobil: "",
                modelbagasi: [],
                modelpintu: [],
                modelbangku: [],
                modelbody: [],
                modeltangga: [],
                modellampubelakang: [],
                newparameter: [],
                stall: "",
                kodekit: "",
            },
            kit: {
                namakit: "",
                result: [],
            }
        }
    },

    methods: {
        add(param) {
            if (param == 'modelbagasi') {
                this.componentsbagasi.push(Componentnewfield)
            }
            else if (param == 'modelpintu') {
                this.componentspintu.push(Componentnewfield)
            }
            else if (param == 'modelbangku') {
                this.componentsbangku.push(Componentnewfield)
            }
            else if (param == 'modelbody') {
                this.componentsbody.push(Componentnewfield)
            }
            else if (param == 'modeltraptangga') {
                this.componentstraptangga.push(Componentnewfield)
            }
            else if (param == 'modellampubelakang') {
                this.componentlampubelakang.push(Componentnewfield)
            }
        },
        Tambahkomponen() {
            let objnewparam = { newparam: "", components: [""] }
            let temp = { newparam: "", components: [] }
            this.parameter.newparameter.push(objnewparam)
            this.componentsnewparameter.push(temp)
        },
        hapuskomponen() {
            this.componentsnewparameter.splice(-1, 1);
            this.parameter.newparameter.splice(-1, 1);
        },
        tambahresultkomponen() {
            let temp = { namakomponen: "", qty: Number, darirak: Number, kerak: Number }
            this.kit.result.push(temp)
        },
        addnewcomponent(index) {
            this.componentsnewparameter[index].components.push("")
            this.parameter.newparameter[index].components.push("")
        },
        removenewcomponen(index) {
            this.componentsnewparameter[index].components.splice(-1, 1);
            this.parameter.newparameter[index].components.splice(-1, 1);
        },
        remove(tipe) {
            // console.log(id)
            if (tipe == 'modelbagasi') {
                this.componentsbagasi.splice(-1, 1);
            }
            if (tipe == 'modelpintu') {
                this.componentspintu.splice(-1, 1);
            }
            if (tipe == 'modelbangku') {
                this.componentsbangku.splice(-1, 1);
            }
            if (tipe == 'modelbody') {
                this.componentsbody.splice(-1, 1);
            }
            if (tipe == 'modeltraptangga') {
                this.componentstraptangga.splice(-1, 1);
            }
            if (tipe == 'modellampubelakang') {
                this.componentlampubelakang.splice(-1, 1);
            }
        },
        handleSubmit() {
            console.log(this.kit)
            console.log(this.parameter)
            let data = {
                datakit: this.kit,
                dataparam: this.parameter
            }
            axios.post('/api/tambahmaster', data).then((response) => {
                if (response.data.status) {
                    console.log(response.data.message)
                    // this.$router.push({
                    //     name: 'User'
                    // })
                }
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        },
        generate(){
            let data = this.parameter.namakit
           axios.get('/api/generatemasterkit', data).then((response) => {
                if (response.data.status) {
                    console.log(response)
                }
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        }

    }
}
</script>
