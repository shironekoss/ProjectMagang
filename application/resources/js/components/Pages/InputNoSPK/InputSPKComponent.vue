<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <span class="adiputro-wirasejati">
                                <b>
                                    <center>INPUT NOMOR SPK</center>
                                </b>
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <form @submit.prevent="">
                                        <div class="col-9 tabel-data-spk" style="float: left;">
                                            <div class="col container">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="form-group row">
                                                            <label class="col col-form-label">Tanggal SPK</label>
                                                            <div class="col">
                                                                <input
                                                                    type="date"
                                                                    class="form-control"
                                                                    id="inputPassword"
                                                                    placeholder="dd-mm-yyyy"
                                                                    v-model="dataspk.TanggalSPK"></div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col col-form-label">Nama</label>
                                                                <div class="col">
                                                                    <input
                                                                        type="text"
                                                                        class="form-control"
                                                                        id="inputPassword"
                                                                        placeholder="Nama"
                                                                        v-model="dataspk.Nama"></div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col col-form-label">Alamat</label>
                                                                    <div class="col">
                                                                        <input
                                                                            type="text"
                                                                            class="form-control"
                                                                            id="inputPassword"
                                                                            placeholder="Alamat"
                                                                            v-model="dataspk.Alamat"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm">
                                                                    <div class="form-group row">
                                                                        <label class="col col-form-label">No. SPK</label>
                                                                        <div class="col">
                                                                            <input
                                                                                type="text"
                                                                                class="form-control"
                                                                                id="inputPassword"
                                                                                placeholder="Nomor SPK"
                                                                                v-model="dataspk.NoSPK"></div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col col-form-label">Tanggal Penerimaan</label>
                                                                            <div class="col">
                                                                                <input
                                                                                    type="date"
                                                                                    class="form-control"
                                                                                    id="inputPassword"
                                                                                    placeholder="dd-mm-yyyy"
                                                                                    v-model="dataspk.TanggalPenerimaan"></div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col col-form-label">Status</label>
                                                                                <div class="col">
                                                                                    <input
                                                                                        type="text"
                                                                                        class="form-control"
                                                                                        id="inputPassword"
                                                                                        placeholder="Masukkan status"
                                                                                        v-model="dataspk.Status"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                            <div class="row">
                                                                                <div class="col-sm" style="float:left;">
                                                                                    <div class="form-group row">
                                                                                        <label class="col col-form-label">Merk</label>
                                                                                        <div class="col">
                                                                                            <input
                                                                                                type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Merek"
                                                                                                v-model="dataspk.Mobil.Merk"></div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col col-form-label">Type Model</label>
                                                                                            <div class="col">
                                                                                                <input
                                                                                                    type="text"
                                                                                                    class="form-control"
                                                                                                    id="inputPassword"
                                                                                                    placeholder="Model"
                                                                                                    v-model="dataspk.Mobil.Type_model"></div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col col-form-label">Tahun</label>
                                                                                                <div class="col">
                                                                                                    <input
                                                                                                        type="number"
                                                                                                        class="form-control"
                                                                                                        id="inputPassword"
                                                                                                        placeholder="Tahun"
                                                                                                        maxlength="4"
                                                                                                        v-model="dataspk.Mobil.Year"></div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm">
                                                                                                <div class="form-group row">
                                                                                                    <label class="col col-form-label">No Series</label>
                                                                                                    <div class="col">
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="form-control"
                                                                                                            id="inputPassword"
                                                                                                            placeholder="Nomor Series"
                                                                                                            v-model="dataspk.Mobil.NoSeries"></div>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <label class="col col-form-label">No Rangka</label>
                                                                                                        <div class="col">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                id="inputPassword"
                                                                                                                placeholder="No Rangka mesin"
                                                                                                                v-model="dataspk.Mobil.NoRangka"></div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <label class="col col-form-label">Keterangan</label>
                                                                                                            <div class="col">
                                                                                                                <input
                                                                                                                    type="multiline"
                                                                                                                    class="form-control"
                                                                                                                    id="inputPassword"
                                                                                                                    placeholder="keterangan"
                                                                                                                    v-model="dataspk.Mobil.Keterangan"></div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="col-3 button-spk" style="float:right;">
                                                                                                <ul style="list-style-type: none;">
                                                                                                    <li>
                                                                                                        <button type="submit" class="btn btn-primary button-input" @click="inputspk">SIMPAN</button>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-success button-input"
                                                                                                            value="DaftarSPK"
                                                                                                            @click="pindahpagedaftar()">Daftar SPK</button>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-warning button-input"
                                                                                                            value="Input Kebutuhan Kit">Input Kebutuhan KIT</button>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </form>

                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <b>Body</b>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div class="col">BAGASI TOOLKIT</div>
                                                                                                <div class="col-8">
                                                                                                    <input type="text">
                                                                                                        <button type="button" @click="add">Add Component</button>
                                                                                                        <button type="button" @click="remove">hapus</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="row">.</div>
                                                                                                <div class="row">
                                                                                                    <div class="col">LAMPU BELAKANG</div>
                                                                                                <div class="col-8">
                                                                                                    <input type="text">
                                                                                                        <button type="button" @click="add">Add Component</button>
                                                                                                        <button type="button" @click="remove">hapus</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                </div>
                                                                                            </div>
                                                                                
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
                                                            export default {
                                                                mounted() {
                                                                    this.dataspk.Mobil.Year = this.getyeartoday()
                                                                    this.dataspk.TanggalPenerimaan = this.getdatetoday()
                                                                    this.dataspk.TanggalSPK = this.getdatetoday()

                                                                },
                                                                data() {
                                                                    return {
                                                                        dataspk: {
                                                                            NoSPK: '',
                                                                            Nama: '',
                                                                            Alamat: '',
                                                                            TanggalPenerimaan: '',
                                                                            TanggalSPK: '',
                                                                            Status: '',
                                                                            Mobil: {
                                                                                Merk: '',
                                                                                Type_model: '',
                                                                                Year: '',
                                                                                NoSeries: '',
                                                                                NoRangka: '',
                                                                                Keterangan: ''
                                                                            }
                                                                        }
                                                                    }
                                                                },
                                                                methods : {
                                                                    getyeartoday() {
                                                                        return new Date().getFullYear()
                                                                    },
                                                                    getdatetoday() {
                                                                        let yourDate = new Date()
                                                                            .toISOString()
                                                                            .slice(0, 10);
                                                                        return yourDate
                                                                    },
                                                                    inputspk() {
                                                                        console.log(this.dataspk)
                                                                        axios
                                                                            .post('/api/tambahSPK', this.dataspk)
                                                                            .then((response) => {
                                                                                console.log(response)
                                                                                if (response.data.status) {
                                                                                    this
                                                                                        .$noty
                                                                                        .success(response.data.message)
                                                                                    // this.$router.push({     name: 'User' })
                                                                                }
                                                                            })
                                                                            .catch((error) => {
                                                                                this.errors = error.response.data.errors
                                                                            })
                                                                    },
                                                                    pindahpagedaftar() {
                                                                        this
                                                                            .$router
                                                                            .push({name: 'DaftarSPK'})
                                                                    }
                                                                }

                                                            }
                                                        </script>

                                                        <style >
                                                            .adiputro-wirasejati {
                                                                font-size: 3em;
                                                            }

                                                            .tabel-data-spk {
                                                                /* background-color: lightgreen; */
                                                            }

                                                            .button-spk {
                                                                /* background-color: aqua; */
                                                            }

                                                            .button-input {
                                                                width: 70%;
                                                                margin: 0.3em;
                                                            }

                                                        </style>