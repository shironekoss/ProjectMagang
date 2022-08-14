<template>
    <div>
        <div class="row">
            <div class="col-6" style="float: left;">
                <div class="row">
                    <div class="col">Kode Mobil</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.kodemobil" class="inputtextparam">
                    </div>
                </div>
                <div class="row">
                    <div class="col">Model Bagasi</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.modelbagasi[0]" class="inputtextparam">
                        <button type="button" :disabled='isActivebagasi' @click="add('modelbagasi')"
                            class="btn btn-primary">Tambah</button>
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
                        <input type="text" v-model="parameter.modelpintu[0]" class="inputtextparam">
                        <button :disabled='isActivepintu' type="button" @click="add('modelpintu')"
                            class="btn btn-primary">Tambah</button>
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
                        <input type="text" v-model="parameter.modelbangku[0]" class="inputtextparam">
                        <button type="button" :disabled='isActivebangku' @click="add('modelbangku')"
                            class="btn btn-primary ">Tambah</button>
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
                        <input type="text" v-model="parameter.modelbody[0]" class="inputtextparam">
                        <button type="button" :disabled='isActivebody' @click="add('modelbody')"
                            class="btn btn-primary">Tambah</button>
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
                        <input type="text" v-model="parameter.modeltangga[0]" class="inputtextparam">
                        <button type="button" :disabled='isActivetangga' @click="add('modeltraptangga')"
                            class="btn btn-primary">Tambah</button>
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
                        <input type="text" v-model="parameter.modellampubelakang[0]" class="inputtextparam">
                        <button type="button" :disabled='isActivelampu' @click="add('modellampubelakang')"
                            class="btn btn-primary">Tambah</button>
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
                        <input type="text" v-model="parameter.stall" class="inputtextparam">
                    </div>
                </div>
                <div class="row">
                    <div class="col">Kode Kit</div>
                    <div class="col-10">
                        <input type="text" v-model="parameter.kodekit" class="inputtextparam">
                        <form @submit.prevent="generate" style="float: right; margin-right: 50%;">
                            <button type="submit" class="btn btn-success">generate</button>
                        </form>
                    </div>
                </div>
                <hr>
                <h3>Additional Parameter</h3>
                <button type="button" @click="Tambahkomponen()" class="btn btn-primary additionalbutton">Tambah
                    Parameter</button>
                <button type="button" @click="hapuskomponen()" class="btn btn-primary additionalbutton">Hapus
                    Komponen</button>
                <div v-for="(component, index) in parameter.newparameter" :key="index" :id=index>
                    <div class="row">
                        <div class="col">
                            <input type="text" v-model="parameter.newparameter[index].newparam" class="newparam">
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
                            <input type="text" v-model="kit.result[index].nama_komponen" class="namakomponenbaru">
                            QTY : <input type="number" v-model="kit.result[index].qty" class="numberinput">
                            dari Rak : <input type="number" v-model="kit.result[index].darirak" class="numberinput">
                            ke rak : <input type="number" v-model="kit.result[index].kerak" class="numberinput">
                        </div>
                    </div>
                </div>
            </div>
            <div>

                <form @submit.prevent="handleSubmit">
                    <div class="row" style="float: left; margin-left: 43%;">
                        <center>
                            <button type="submit" class="btn btn-success"> Simpan</button>
                        </center>
                    </div>
                </form>
            </div>
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
            isActivepintu: true,
            isActivebagasi: true,
            isActivebangku: true,
            isActivebody: true,
            isActivetangga: true,
            isActivelampu: true,
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
    watch: {
        'parameter.modelbagasi': function () {
            let sama = 0
            this.parameter.modelbagasi.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivebagasi = false
            } else {
                return this.isActivebagasi = true
            }
        },
        'parameter.modelpintu': function () {
            let sama = 0
            this.parameter.modelpintu.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivepintu = false
            } else {
                return this.isActivepintu = true
            }
        },
        'parameter.modelbangku': function () {
            let sama = 0
            this.parameter.modelbangku.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivebangku = false
            } else {
                return this.isActivebangku = true
            }
        },
        'parameter.modelbody': function () {
            let sama = 0
            this.parameter.modelbody.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivebody = false
            } else {
                return this.isActivebody = true
            }
        },
         'parameter.modeltangga': function () {
            let sama = 0
            this.parameter.modeltangga.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivetangga = false
            } else {
                return this.isActivetangga = true
            }
        },
        'parameter.modellampubelakang': function () {
            let sama = 0
            this.parameter.modellampubelakang.forEach(element => {
                if (element == "") {
                    sama++;
                }
            });
            if (sama == 0) {
                return this.isActivelampu = false
            } else {
                return this.isActivelampu = true
            }
        }
    },

    methods: {

        add(param) {
            if (param == 'modelbagasi') {
                this.componentsbagasi.push(Componentnewfield)
                this.isActivebagasi = true
            }
            else if (param == 'modelpintu') {
                this.componentspintu.push(Componentnewfield)
                this.isActivepintu = true
            }
            else if (param == 'modelbangku') {
                this.componentsbangku.push(Componentnewfield)
                 this.isActivebangku = true
            }
            else if (param == 'modelbody') {
                this.componentsbody.push(Componentnewfield)
                 this.isActivebody = true
            }
            else if (param == 'modeltraptangga') {
                this.componentstraptangga.push(Componentnewfield)
                 this.isActivetangga = true
            }
            else if (param == 'modellampubelakang') {
                this.componentlampubelakang.push(Componentnewfield)
                 this.isActivelampu = true
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
            let temp = { nama_komponen: "", qty: Number, darirak: Number, kerak: Number }
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
                this.parameter.modelbagasi.splice(-1, 1);
                this.isActivebagasi = true
            }
            if (tipe == 'modelpintu') {
                this.componentspintu.splice(-1, 1);
                 this.parameter.modelpintu.splice(-1, 1);
                this.isActivepintu = true
            }
            if (tipe == 'modelbangku') {
                this.componentsbangku.splice(-1, 1);
                 this.parameter.modelbangku.splice(-1, 1);
                this.isActivebangku = true
            }
            if (tipe == 'modelbody') {
                this.componentsbody.splice(-1, 1);
                 this.parameter.modelbody.splice(-1, 1);
                this.isActivebody = true
            }
            if (tipe == 'modeltraptangga') {
                this.componentstraptangga.splice(-1, 1);
                this.parameter.modeltangga.splice(-1, 1);
                this.isActivetangga = true
            }
            if (tipe == 'modellampubelakang') {
                this.componentlampubelakang.splice(-1, 1);
                 this.parameter.modellampubelakang.splice(-1, 1);
                this.isActivelampu = true
            }
        },
        handleSubmit() {
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
        generate() {
            let data = {
                param: this.parameter.kodekit
            }
            axios.post('/api/generatemasterkit', data).then((response) => {
                if (response.data.status) {
                    console.log(response.data.result)
                    // console.log(data)
                    this.kit.namakit = response.data.result.nama_kit
                    this.kit.result = response.data.result.komponen
                }
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        }
    }
}
</script>
<style scoped>
.inputtextparam {
    width: 200px;
}

.btn-primary {
    margin-left: 15px;
    margin-right: 15px;
}

.additionalbutton {
    margin-bottom: 15px;
    margin-top: 15px;
}

.newparam {
    min-width: 100px;
    max-width: 130px;
    max-height: 37px;
}

.numberinput {
    width: 50px;
}

.namakomponenbaru {
    min-width: 300px;
}
</style>
