<template>
    <div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <span class="adiputro-wirasejati">
                        <b><center>INPUT NOMOR SPK</center></b>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-8 tabel-data-spk">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col col-form-label">Tanggal SPK</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="inputPassword" placeholder="Masukkan tanggal (nanti di ganti date time picker)">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col col-form-label">Nama</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="inputPassword" placeholder="Nama">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col col-form-label">Alamat</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" id="inputPassword" placeholder="Alamat">
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group row">
                                                    <label class="col col-form-label">No. SPK</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inputPassword" placeholder="Nomor SPK">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col col-form-label">Tanggal Penerimaan</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inputPassword" placeholder="Masukkan tanggal penerimaan (nanti di ganti date time picker)">
                                                    </div>
                                                </div>

                                                <div class="form-group row"> 
                                                    <label class="col col-form-label">Status</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inputPassword" placeholder="Masukkan status">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col border border-dark">
                                                <div class="row">Merk</div>
                                                <div class="row">ISUZU</div>
                                            </div>
                                            <div class="col border border-dark">
                                                <div class="row">Type / Model</div>
                                                <div class="row">NLR55BLX</div>
                                            </div>
                                            <div class="col border border-dark">
                                                <div class="row">Tahun</div>
                                                <div class="row">2022</div>
                                            </div>
                                            <div class="col border border-dark">
                                                <div class="row">No Serie</div>
                                                <div class="row"></div>
                                            </div>
                                            <div class="col border border-dark">
                                                <div class="row">No Rangka</div>
                                                <div class="row">MHCNLR55</div>
                                            </div>
                                            <div class="col border border-dark">
                                                <div class="row">Header</div>
                                                <div class="row">isi</div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="col button-spk">
                                    <ul style="list-style-type: none;">
                                        <li><button type="button" class="btn btn-primary button-input">SIMPAN</button></li>
                                        <li><button type="button" class="btn btn-success button-input">INPUT SPK</button></li>
                                        <li><button type="button" class="btn btn-warning button-input">Input Kebutuhan KIT</button></li>
                                    </ul>
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
            console.log('Component mounted.')
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
.button-spk{
    /* background-color: aqua; */
}
.button-input{
    width: 70%;
    margin: 0.3em;
}
</style>
