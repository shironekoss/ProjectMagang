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
                                    tipe="TipeMobil" class="row">
                                    <div class="col-6">
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
                                    tipe="ModelMobil" class="row">
                                    <div class="col-6">
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
                                        <button type="button" :disabled='isActiveTinggiMobil'
                                            @click="add('TinggiMobil')" class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('TinggiMobil')"
                                            class="btn btn-danger">HAPUS
                                        </button>
                                    </div>
                                </div>
                                <div v-for="(component, index) in ComponentTambahanTinggiMobil" :key="index" :id=index
                                    tipe="TinggiMobil" class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.TinggiMobil[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Departemen</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <!-- <div class="col-6">
                                        <input type="text" v-model="Parameter.Departemen[0]" class="form-control">
                                    </div> -->
                                    <div class="col-6">
                                        <div data-app>
                                            <v-select :items="ListDept" item-text="text" item-value="value"
                                                v-model="Parameter.Departemen[0]" required class="form-control">
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="button" :disabled='isActiveDepartemen' @click="add('Departemen')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('Departemen')" class="btn btn-danger">HAPUS
                                        </button>
                                    </div>
                                </div>
                                <div v-for="(component, index) in ComponentTambahanDepartemen" :key="index" :id=index
                                    tipe="Departemen" class="row">
                                    <div class="col-6">
                                        <div data-app>
                                            <v-select :items="ListDept" item-text="text" item-value="value"
                                                v-model="Parameter.Departemen[index+1]" required class="form-control">
                                            </v-select>
                                        </div>
                                    </div>
                                </div>
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
                                        <button type="button" :disabled='isActiveStock' @click="add('Stock')"
                                            class="btn btn-primary">TAMBAH</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="remove('Stock')" class="btn btn-danger">HAPUS
                                        </button>
                                    </div>
                                </div>
                                <div v-for="(component, index) in ComponentTambahanStock" :key="index" :id=index
                                    tipe="Stock" class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="Parameter.Stock[index + 1]" required
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3>Additional Parameter</h3>
                                <button type="button" @click="Tambahkomponen()"
                                    class="btn btn-primary additionalbutton">Tambah
                                    Parameter</button>
                                <button type="button" @click="hapuskomponen()"
                                    class="btn btn-primary additionalbutton">Hapus
                                    Komponen</button>
                                <div v-for="(component, index) in Parameter.NewParameter" :key="index" :id=index>
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="text" v-model="Parameter.NewParameter[index].Newparam"
                                                class="newparam form-control">
                                        </div>
                                        <div class="col-6">
                                            <div v-for="(component2, index2) in component.Component" :key="index2"
                                                :id=index2>
                                                <input type="text"
                                                    v-model="Parameter.NewParameter[index].Component[index2]"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button type="button" @click="addnewcomponent(index)"
                                                class="btn btn-primary">Tambah</button>
                                            <button type="button" @click="removenewcomponen(index)"
                                                class="btn btn-danger">hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6" style=" float: right;">
                        <div class="row">
                            <div class="col">
                                <h5>Kode Kit</h5>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" v-model="InputKodeKit" class="form-control">
                                    </div>
                                    <div class="col">
                                        <button type="button" @click="generate"
                                            class="btn btn-secondary">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-for="(component, index) in Result" :key="index" :id=index
                            style="border: 2px solid blue; border-radius: 25px; padding: 10px; margin: 5px;">
                            <h4> Nama Kit : {{component.NamaKit}} <span><Button @click="HapusResult(index)"
                                        class="btn btn-danger">Hapus</Button></span></h4>
                            <div v-for="(subcomponent, index2) in component.IsiKit" :key="index2" :id=index2>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-6">
                                                Nama Komponen
                                                <input type="text" v-model="component.IsiKit[index2].nama_komponen"
                                                    class="form-control">
                                            </div>

                                            <div class="col">
                                                QTY :
                                                <input type="number" v-model="component.IsiKit[index2].qty"
                                                    class="form-control">
                                            </div>

                                            <div class="col">
                                                dari Rak :
                                                <input type="text" v-model="component.IsiKit[index2].darirak"
                                                    class="form-control" min="0">
                                            </div>

                                            <div class="col">
                                                ke rak :
                                                <input type="text" v-model="component.IsiKit[index2].kerak"
                                                    class="form-control" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="handleSubmit">
                        <div class="row">
                            <center>
                                <button type="submit" class="btn btn-success btn-lg">
                                    Update</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
import axios from 'axios'
import { Result } from 'postcss'
export default {
    props: ['id'],
    data() {
        return {
            isActivebangku: true,

            isActiveTipeMobil: true,
            isActiveModelMobil: true,
            isActiveTinggiMobil: true,
            isActiveDepartemen: true,
            isActiveStock: true,
            ComponentTambahanTipeMobil: [],
            ComponentTambahanModelMobil: [],
            ComponentTambahanTinggiMobil: [],
            ComponentTambahanDepartemen: [],
            ComponentTambahanStock: [],
            InputKodeKit: "",
            Parameter: {
                TipeMobil: [],
                ModelMobil: [],
                TinggiMobil: [],
                Departemen: [],
                Stock: [],
                NewParameter: [],
            },
            Result: [],
            ListDept: [],
        }
    },
    mounted() {
        this.getspk(),
        this.getlistdepartemen()
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
        },
        'Parameter.TinggiMobil': function () {
            if (this.Parameter.TinggiMobil.length == 0) {
                return this.isActiveTinggiMobil = true
            } else {
                let sama = 0
                this.Parameter.TinggiMobil.forEach(element => {
                    if (element == "") {
                        sama++
                    }
                });
                if (sama == 0) {
                    return this.isActiveTinggiMobil = false
                } else {
                    return this.isActiveTinggiMobil = true
                }
            }
        },
        'Parameter.Departemen': function () {
            if (this.Parameter.Departemen.length == 0) {
                return this.isActiveDepartemen = true
            } else {
                let sama = 0
                this.Parameter.Departemen.forEach(element => {
                    if (element == "") {
                        sama++
                    }
                });
                if (sama == 0) {
                    return this.isActiveDepartemen = false
                } else {
                    return this.isActiveDepartemen = true
                }
            }
        },
        'Parameter.Stock': function () {
            if (this.Parameter.Stock.length == 0) {
                return this.isActiveStock = true
            } else {
                let sama = 0
                this.Parameter.Stock.forEach(element => {
                    if (element == "") {
                        sama++
                    }
                });
                if (sama == 0) {
                    return this.isActiveStock = false
                } else {
                    return this.isActiveStock = true
                }
            }
        }
    },

    methods: {
        add(param) {
            if (param == 'TipeMobil') {
                this.ComponentTambahanTipeMobil.push('true')
                this.Parameter.TipeMobil.push("")
            } else if (param == 'ModelMobil') {
                this.ComponentTambahanModelMobil.push('true')
                this.Parameter.ModelMobil.push("")
            } else if (param == 'TinggiMobil') {
                this.ComponentTambahanTinggiMobil.push('true')
                this.Parameter.TinggiMobil.push("")
            } else if (param == 'Departemen') {
                this.ComponentTambahanDepartemen.push('true')
                this.Parameter.Departemen.push("")
            } else if (param == 'Stock') {
                this.ComponentTambahanStock.push('true')
                this.Parameter.Stock.push("")
            }
        },
        getspk() {
            axios.get('/api/master/' + this.id).then((response) => {
                this.Parameter=response.data.Parameter
                this.Result=response.data.Kit
                if(this.Parameter['TipeMobil'].length>1){
                    for (let i = 1; i < this.Parameter['TipeMobil'].length; i++) {
                        this.ComponentTambahanTipeMobil.push('true')
                    }
                }
                if(this.Parameter['ModelMobil'].length>1){
                    for (let i = 1; i < this.Parameter['ModelMobil'].length; i++) {
                        this.ComponentTambahanModelMobil.push('true')
                    }
                }
                if(this.Parameter['TinggiMobil'].length>1){
                    for (let i = 1; i < this.Parameter['TinggiMobil'].length; i++) {
                        this.ComponentTambahanTinggiMobil.push('true')
                    }
                }
                if(this.Parameter['Departemen'].length>1){
                    for (let i = 1; i < this.Parameter['Departemen'].length; i++) {
                        this.ComponentTambahanDepartemen.push('true')
                    }
                }
                if(this.Parameter['Stock'].length>1){
                    for (let i = 1; i < this.Parameter['Stock'].length; i++) {
                        this.ComponentTambahanStock.push('true')
                    }
                }
            })
        },
        getlistdepartemen() {
            axios.get('/api/listdepartemen').then((response) => {
                this.ListDept = response.data.data
            })
        },
        generate() {
            let data = {
                param: this.InputKodeKit
            }
            axios.post('/api/generatemasterkit', data).then((response) => {
                console.log(response.data)
                if (response.data.success) {
                    if (response.data.statuscode == 201) {
                        let datanamakit = response.data.result.nama_kit
                        let dataKodeKit = response.data.result.kode_kit
                        let dataisikit = response.data.result.komponen
                        let kembar = false
                        this.Result.forEach(element => {
                            if (element.NamaKit.toUpperCase() == datanamakit.toUpperCase()) {
                                kembar = true
                            }
                        });
                        if (kembar) {
                            this.$swal({
                                title: 'Kode Kit ' + this.InputKodeKit + ' sudah ada',
                                icon: 'error'
                            });
                        } else {
                            this.Result.push({ NamaKit: datanamakit, Kodekit: dataKodeKit, IsiKit: dataisikit })
                            this.$swal({
                                title: 'Sukses generate data ' + response.data.result.kode_kit.toUpperCase(),
                                icon: 'success'
                            });
                        }
                    } else if (response.data.statuscode == 400) {
                        this.$swal({
                            title: 'Kode Kit ' + this.InputKodeKit + ' ' + response.data.message,
                            icon: 'error'
                        });
                    }
                }
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        },
        HapusResult(index) {
            if (index > -1) {
                this.Result.splice(index, 1)
            }
        },
        Tambahkomponen() {
            let objnewparam = {
                Newparam: "",
                Component: [""]
            }
            this.Parameter.NewParameter.push(objnewparam)
        },
        hapuskomponen() {
            this.Parameter.NewParameter.splice(-1, 1);
        },
        addnewcomponent(index) {
            this.Parameter.NewParameter[index].Component.push("");
        },
        removenewcomponen(index) {
            if (this.Parameter.NewParameter[index].Component.length > 1) {
                this.Parameter.NewParameter[index].Component.splice(-1, 1)
            }
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
            if (tipe == 'TinggiMobil') {
                this.ComponentTambahanTinggiMobil.splice(-1, 1)
                this.Parameter.TinggiMobil.splice(-1, 1)
            }
            if (tipe == 'Departemen') {
                this.ComponentTambahanDepartemen.splice(-1, 1)
                this.Parameter.Departemen.splice(-1, 1)
            }
            if (tipe == 'Stock') {
                this.ComponentTambahanStock.splice(-1, 1)
                this.Parameter.Stock.splice(-1, 1)
            }
        },

        handleSubmit() {
            let data = {
                datakit: this.Result,
                dataparam: this.Parameter,
                id:this.id
            }
            axios.post('/api/updatemaster', data).then((response) => {
                if (response.data.success) {
                    if (response.data.statuscode == 401) {
                        this.$swal({ title: 'Ada Parameter yang Kosong', icon: 'error' });
                    }
                    if (response.data.statuscode == 402) {
                        this.$swal({ title: 'Ada Field yang memiliki parameter kembar', icon: 'error' });
                    }
                    if (response.data.statuscode == 403) {
                        this.$swal({ title: 'Pengisian Parameter Tambahan ada yang Kosong', icon: 'error' });
                    }
                    if (response.data.statuscode == 404) {
                        this.$swal({ title: 'Pengisian Parameter Tambahan kembar, perhatikan kembali pengisiannya', icon: 'error' });
                    }
                    if (response.data.statuscode == 405) {
                        this.$swal({ title: 'Kit Kosong Harus ada kit Minimal 1, Tolong generate', icon: 'error' });
                    }
                    if (response.data.statuscode == 406) {
                        this.$swal({ title: 'Master dengan Parameter ini sudah terdaftar', icon: 'error' });
                    }
                    if (response.data.statuscode == 407) {
                        this.$swal({ title: 'Pengisian Additional parameter ', icon: 'error' });
                    }
                    if (response.data.statuscode == 408) {
                        this.$swal({ title: 'Nama Komponen Kit atau Qty Tidak boleh Kosong ', icon: 'error' });
                    }
                    if (response.data.statuscode == 410) {
                        this.$swal({ title: 'Kit Rak masih ada yang kosong', icon: 'error' });
                    }
                    if (response.data.statuscode == 200) {
                        this.$swal({ title: 'Sukses Menambahkan Master', icon: 'success' });
                    }

                }
            })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },

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
</style>
