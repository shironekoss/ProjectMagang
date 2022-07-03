<template>
    <div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <span class="adiputro-wirasejati">
                        <b><center>PT Adiputro Wirasejati</center></b>
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-8 tabel-data-spk">
                                    <div class="container">
                                        <form>
                                            <div class="form-group row">
                                                <label class="col col-form-label">Tanggal SPK</label>
                                                <div class="col">
                                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                                </div>
                                            </div>
                                        </form>
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
    background-color: lightgreen;
}
.button-spk{
    background-color: aqua;
}
.button-input{
    width: 70%;
    margin: 0.3em;
}
</style>
