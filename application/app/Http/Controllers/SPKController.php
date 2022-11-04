<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Komponen;
use App\Models\Masterkit;
use App\Models\TempMasterkit;
use App\Models\SPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;

class SPKController extends Controller
{
    public function filternospk()
    {
        $teks1 = "B09EKS29";
        $regex = "/[A-Z]{1,7}+/";
        $hasil = [];
        try {
            preg_match_all($regex, $teks1, $hasil);
            dd($hasil[0][1]);
        } catch (\Throwable $th) {
            dd("kode salah");
        }
        # kembalikan data dalam bentuk json

        // $hasil=Komponen::all()->where('kode_mobil.tipe_FEL',true);
        // dd($hasil);
    }

    public function spklist()
    {
        $spklist = SPK::all();
        return response()->json([
            "status" => true,
            "data" => $spklist
        ]);
    }

    public function latihan()
    {
        $datas = DB::connection('sqlsrv')->table('ITEMKITMAINTENANCE')->get();

        // dd($datas[0]->{'Item KIT Number'});
        foreach ($datas as $data) {
            $datatersimpan = TempMasterkit::where('kode_kit', trim($data->{'Item KIT Number'}))->first();
            // dd($datatersimpan);
            if ($datatersimpan == null) {
                $newdata = TempMasterkit::create([
                    "kode_kit" =>  trim($data->{'Item KIT Number'}),
                    'nama_kit' => trim($data->{'Item KIT Description'}),
                    'komponen' => [
                        [
                            'kode_komponen' => trim($data->{'Component Item Number'}),
                            // 'deskripsi_komponen' => trim($data->{'Component Item Number'},
                            'nama_komponen' => trim($data->{'Component Item Description'}),
                            'qty' =>   trim($data->{'Component Item QTY'}),
                            'Satuan' => trim($data->{'Component Item UofM'}),
                        ],
                    ],
                ]);
            } else {
                $terdaftar = false;
                $array = $datatersimpan->komponen;

                foreach ($array as $saved) {
                    // dd($array);

                    // dd($data);
                    if ($saved['kode_komponen'] === trim($data->{'Component Item Number'})) {
                        $terdaftar = true;
                    }
                }
                if (!$terdaftar) {

                    array_push($array, [
                        'kode_komponen' => trim($data->{'Component Item Number'}),
                        'nama_komponen' => trim($data->{'Component Item Description'}),
                        'qty' =>   trim($data->{'Component Item QTY'}),
                        'Satuan' => trim($data->{'Component Item UofM'}),
                    ]);
                    $datatersimpan->komponen = $array;
                    $datatersimpan->save();
                } else {
                    $index = 0;
                    foreach ($array as $saved) {
                        if ($saved['kode_komponen'] === trim($data->{'Component Item Number'})) {
                            // dd($datatersimpan->komponen[$index]);
                            if ($saved['nama_komponen'] != trim($data->{'Component Item Description'}) ||$saved['qty'] != trim($data->{'Component Item QTY'}) ||$saved['Satuan'] != trim($data->{'Component Item UofM'}) ) {
                                $new = array(
                                    'kode_komponen' => trim($data->{'Component Item Number'}),
                                    'nama_komponen' => trim($data->{'Component Item Description'}),
                                    'qty' =>   trim($data->{'Component Item QTY'}),
                                    'Satuan' => trim($data->{'Component Item UofM'}),
                                );
                                $array[$index]= $new;
                                $datatersimpan->komponen = $array;
                                $datatersimpan->save();
                            }
                        }
                        $index++;
                    }
                }
            }
            // dd(trim($datas[0]->{"Item KIT Number"}));
        }
    }

    public function tambahSPK(Request $request)
    {

        // $validated = $request->validate([
        //     'NoSPK' => 'required|min:5|max:20|unique:App\Models\Account,account_username',
        //     'Nama' => 'required',
        //     'Alamat' => 'required',
        //     'TanggalPenerimaan' => 'required',
        //     'TanggalSPK' => 'required',
        //     'Status' => 'required',
        //     'Mobil.Merk' => 'required',
        //     'Mobil.Type_model' => 'required',
        //     'Mobil.Year' => 'required',
        //     'Mobil.NoSeries' => 'required',
        //     'Mobil.NoRangka' => 'required',

        // ]);
        $newmobil = SPK::create([
            "NoSPK" => $request->NoSPK,
            "Nama" => $request->Nama,
            "Alamat" => $request->Alamat,
            "TanggalPenerimaan" => $request->TanggalPenerimaan,
            "TanggalSPK" => $request->TanggalSPK,
            "Status" => $request->Status,
            'Mobil' => $request->Mobil,
            "status_SPK" => false,
            "Last_edit" => "",
        ]);
        return response()->json([
            "status" => true,
            "message" => 'Data user berhasil disimpan',
            "data" => $newmobil
        ]);
    }
}
