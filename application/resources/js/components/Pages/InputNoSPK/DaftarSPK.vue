<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <span class="adiputro-wirasejati">
                            <b>
                                <center>Daftar SPK</center>
                            </b>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row" v-for="SPK in daftarSPK">
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>NO SPK</center>
                                </div><br>
                                <div class="row">{{ SPK.NoSPK }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>Merk</center>
                                </div><br>
                                <div class="row">{{ SPK.Mobil.Merk }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>Type / Model</center>
                                </div><br>
                                <div class="row">{{ SPK.Mobil.Type_model }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>No Series</center>
                                </div><br>
                                <div class="row">{{ SPK.Mobil.NoSeries }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>No Rangka</center>
                                </div><br>
                                <div class="row">{{ SPK.Mobil.NoRangka }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>Last Time Update</center>
                                </div><br>
                                <div class="row">{{ SPK.updated_at }}</div>
                            </div>
                            <div class="col border border-dark">
                                <div class="row">
                                    <center>Last User Update</center>
                                </div><br>
                                <div class="row"></div>
                            </div>
                            <div class="col border border-dark">
                                <button class="btn btn-primary" @click="">Isi Detail</button>
                                <button class="btn btn-danger" @click="">Hapus</button>
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
    data() {
        return {
            daftarSPK: [],
        }
    },
    mounted() {
        this.getspklist()
    },
    methods: {
        getspklist() {
            axios.get('/api/spklist').then((response) => {
                this.daftarSPK = response.data.data
            })
        },
        ubahtanggaliso(isodate) {

        },

        // profile_url(name) {
        //     return '/user/' + name.toLowerCase()
        // },
        // cara2

    }
}
</script>
