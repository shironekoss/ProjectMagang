<template>

    <div>
        <div class="card" style="width: 95rem;">
            <div class="card-body">
                <div class="row">
                    <div class="col-6" style="float: left;">
                        <!-- <div class="row">
                            <div class="col">
                                <h5>Merk</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <input type="text" v-model="parameter.kodemobil" class="form-control">
                                </div>

                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col">
                                <h5>Tipe Mobil</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.TipeMobil[0]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="button" :disabled='isActiveTipeMobil' @click="add('TipeMobil')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('TipeMobil')" class="btn btn-danger">
                                            HAPUS
                                        </button>
                                    </div>
                                </div>

                                <div v-for="(component, index) in ComponentTambahanTipeMobil" :key="index" :id=index
                                    tipe="TipeMobil">
                                    <div class="col-10">
                                        <input type="text" v-model="Parameter.TipeMobil[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Model Mobil</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.ModelMobil[0]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="button" :disabled='isActiveModelMobil' @click="add('ModelMobil')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('ModelMobil')" class="btn btn-danger">
                                            HAPUS
                                        </button>
                                    </div>
                                </div>

                                <div v-for="(component, index) in ComponentTambahanModelMobil" :key="index" :id=index
                                    tipe="modelbagasi">
                                    <div class="col-10">
                                        <input type="text" v-model="Parameter.ModelMobil[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Tinggi Mobil</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.TinggiMobil[0]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="button" :disabled='isActivebangku' @click="add('modelbangku')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('modelbangku')"
                                            class="btn btn-danger">HAPUS
                                        </button>
                                    </div>
                                </div>

                                <!-- <div v-for="(component, index) in componentsbangku" :key="index" :id=index
                                    tipe="modelbangku">
                                    <div class="col-10">
                                        <input type="text" v-model="parameter.modelbangku[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Departemen</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.Departemen[0]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button :disabled='isActivepintu' type="button" @click="add('modelpintu')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('modelpintu')" class="btn btn-danger">HAPUS
                                        </button>
                                    </div>
                                </div>
                                <!-- <component v-for="(component, index) in componentspintu" :key="index" :id=index
                                    tipe="modelpintu">
                                    <div class="col-10">
                                        <input type="text" v-model="parameter.modelpintu[index + 1]" required
                                            class="form-control">
                                    </div>
                                </component> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Stock</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.Stock[0]" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="button" :disabled='isActivebagasi' @click="add('modelbagasi')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('modelbagasi')" class="btn btn-danger">
                                            HAPUS
                                        </button>
                                    </div>
                                </div>
                                <!-- <div v-for="(component, index) in componentsbagasi" :key="index" :id=index
                                    tipe="modelbagasi">
                                    <div class="col-10">
                                        <input type="text" v-model="parameter.modelbagasi[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="handleSubmit">
                        <div class="row">
                            <center>
                                <button type="submit" class="btn btn-success btn-lg">
                                    SIMPAN</button>
                            </center>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col tengah">
                        <h3>Additional Parameter</h3>
                        <button type="button" @click="Tambahkomponen()" class="btn btn-primary additionalbutton">Tambah
                            Parameter</button>
                        <button type="button" @click="hapuskomponen()" class="btn btn-primary additionalbutton">Hapus
                            Komponen</button>

                        <div v-for="(component, index) in Parameter.newparameter" :key="index" :id=index>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" v-model="parameter.newparameter[index].newparam"
                                        class="newparam form-control">
                                </div>
                                <div class="col-3">
                                    <input type="text" v-model="parameter.newparameter[index].components[0]"
                                        class="form-control">
                                    <div v-for="(component2, index2) in componentsnewparameter[index].components"
                                        :key="index2" :id=index2>
                                        <div class="col">
                                            <input type="text"
                                                v-model="parameter.newparameter[index].components[index2 + 1]"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="button" @click="addnewcomponent(index)"
                                        class="btn btn-primary">Tambah</button>
                                    <button type="button" @click="removenewcomponen(index)" class="btn btn-danger">hapus
                                        tambahan</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
import axios from 'axios'

const Componentnewfield = {
    props: {
        id: Number,
        tipe: String
    },
    data() {
        return { value: "" }
    },

    template: `<div class="col-8">
    <input type="text" class="form-control">
    </div>`,
    methods: {}
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

            isActiveTipeMobil: true,
            isActiveModelMobil: true,
            isActiveTinggiMobil: true,
            isActiveDepartemen: true,
            isActiveStock: true,
            ComponentTambahanTipeMobil: [],
            ComponentTambahanModelMobil: [],

            componentsbagasi: [],


            Parameter: {
                TipeMobil: [],
                ModelMobil: [],
                TinggiMobil: [],
                Departemen: [],
                Stock: [],

                newparameter: [],
            },
            kit: {
                kodekit: "",
                namakit: "",
                result: []
            }
        }
    },
    watch: {
        'Parameter.TipeMobil': function () {
            if (this.Parameter.TipeMobil.length == 0) {
                return this.isActiveTipeMobil = true
            } else {
                let sama = 0
                this.Parameter.TipeMobil.forEach(element => {
                    if (element == "") {
                        sama++
                    }
                });
                if (sama == 0) {
                    return this.isActiveTipeMobil = false
                } else {
                    return this.isActiveTipeMobil = true
                }
            }
        },
        'Parameter.ModelMobil': function () {
            if (this.Parameter.ModelMobil.length == 0) {
                return this.isActiveModelMobil = true
            } else {
                let sama = 0
                this.Parameter.ModelMobil.forEach(element => {
                    console.log(element)
                    if (element == "") {
                        sama++
                    }
                });
                if (sama == 0) {
                    return this.isActiveModelMobil = false
                } else {
                    return this.isActiveModelMobil = true
                }
            }
        }
    },

    methods: {
        add(param) {
            if (param == 'TipeMobil') {
                this.ComponentTambahanTipeMobil.push('true')
                this.Parameter.TipeMobil.push("")
                this.isActivebagasi = true
            }
            if (param == 'ModelMobil') {
                this.ComponentTambahanModelMobil.push('true')
                this.Parameter.ModelMobil.push("")
                this.isActiveModelMobil = true
            }
        },
        Tambahkomponen() {
            let objnewparam = {
                newparam: "",
                components: [""]
            }
            let temp = {
                newparam: "",
                components: []
            }
            this
                .parameter
                .newparameter
                .push(objnewparam)
            this
                .componentsnewparameter
                .push(temp)
        },
        hapuskomponen() {
            this
                .componentsnewparameter
                .splice(-1, 1);
            this
                .parameter
                .newparameter
                .splice(-1, 1);
        },
        tambahresultkomponen() {
            let temp = {
                nama_komponen: "",
                qty: null,
                darirak: null,
                kerak: null
            }
            this
                .kit
                .result
                .push(temp)
        },
        addnewcomponent(index) {
            this
                .componentsnewparameter[index]
                .components
                .push("")
            this
                .parameter
                .newparameter[index]
                .components
                .push("")
        },
        removenewcomponen(index) {
            this
                .componentsnewparameter[index]
                .components
                .splice(-1, 1);
            this
                .parameter
                .newparameter[index]
                .components
                .splice(-1, 1);
        },
        remove(tipe) {
            if (tipe == 'TipeMobil') {
                this.ComponentTambahanTipeMobil.splice(-1, 1)
                this.Parameter.TipeMobil.splice(-1, 1)
            }
            if (tipe == 'ModelMobil') {
                this.ComponentTambahanModelMobil.splice(-1, 1)
                this.Parameter.ModelMobil.splice(-1, 1)
            }
        },
        handleSubmit() {
            let data = {
                datakit: this.kit,
                dataparam: this.parameter
            }
            axios
                .post('/api/tambahmaster', data)
                .then((response) => {
                    if (response.data.success) {
                        if (response.data.statuscode == 402) {
                            this.$swal({ title: 'Nama Kit Belum Diisi', icon: 'error' });
                        } else if (response.data.statuscode == 403) {
                            this.$swal({ title: 'Komponen Tidak ada', icon: 'error' });
                        } else if (response.data.statuscode == 404) {
                            this.$swal({ title: 'Pengisian komponen tidak lengkap', icon: 'error' });
                        } else if (response.data.statuscode == 405) {
                            this.$swal({ title: 'Pengisian Parameter Tidak Lengkap', icon: 'error' });
                        } else if (response.data.statuscode == 406) {
                            this.$swal({ title: 'Pengisian Parameter ada yang kembar', icon: 'error' });
                        } else if (response.data.statuscode == 407) {
                            this.$swal({ title: 'Master dengan parameter ini Sudah Terdaftar', icon: 'error' });
                        } else if (response.data.statuscode == 408) {
                            this.$swal({ title: 'Parameter tambahan ada yang Kosong', icon: 'error' });
                        } else if (response.data.statuscode == 409) {
                            this.$swal({ title: 'Parameter tambahan ada yang sama', icon: 'error' });
                        } else if (response.data.statuscode == 410) {
                            this.$swal({ title: 'dari rak ke rak belum diisi', icon: 'error' });
                        } else if (response.data.statuscode == 411) {
                            this.$swal({ title: 'parameter tambahan kembar', icon: 'error' });
                        } else if (response.data.statuscode == 200) {
                            this.$swal({ title: 'sukses nambah data', icon: 'success' });
                        }
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        generate() {
            let data = {
                param: this.kit.kodekit
            }

            axios
                .post('/api/generatemasterkit', data)
                .then((response) => {
                    console.log(response.data)
                    if (response.data.success) {
                        if (response.data.statuscode == 201) {
                            this.kit.namakit = response.data.result.nama_kit
                            this.kit.result = response.data.result.komponen
                            this.$swal({
                                title: 'Sukses generate data ' + this
                                    .kit
                                    .kodekit
                                    .toUpperCase(),
                                icon: 'success'
                            });
                        } else if (response.data.statuscode == 401) {
                            this.$swal({
                                title: 'Kode Kit ' + this
                                    .parameter
                                    .kodekit
                                    .toUpperCase() + " Tidak tersedia",
                                icon: 'error'
                            });
                        }
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        }
    }
}
</script>

<style>
.card {
    margin: 0 auto;
    /* Added */
    float: none;
    /* Added */
    margin-bottom: 10px;
    /* Added */
}

.col {
    padding: -35px;
}

.tengah {
    margin: 0 auto;
    /* Added */
    float: none;
}
</style>
