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
        // join
        // $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
        //     ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
        //     ->get();
        // foreach ($datas as $data) {
        //     $datatersimpan = SPK::where('NOSPK', trim($data->{'SPK Number'}))->first();
        //     if ($datatersimpan == null) {
        //         $newdata = SPK::create([
        //             "NOSPK" => trim($data->{'SPK Number'}),
        //             "parameter" =>  [
        //                 "ModelMobil" => trim($data->{'Merk'}),
        //                 "TipeMobil" => trim($data->{'Type'}),
        //                 "TinggiMobil" => "",
        //                 "newparameter" =>  [
        //                     [
        //                         trim($data->{'User Defined'}) => trim($data->{'User Defined Description'})
        //                     ],
        //                 ]
        //             ]
        //         ]);
        //     } else {
        //         $terdaftar = false;
        //         if (trim($data->{'User Defined'}) == "TINGGI BODY") {
        //             $array = $datatersimpan->parameter;

        //             $array["TinggiMobil"] = trim($data->{'User Defined Description'});

        //             $datatersimpan->parameter = $array;

        //             $datatersimpan->save();
        //         } else {
        //             $array = $datatersimpan->parameter;
        //             // dd($array["newparameter"]);
        //             $sama = false;
        //             foreach ($array["newparameter"] as $subarray) {
        //                 $run = $subarray[trim($data->{'User Defined'})] ?? null;
        //                 if ($run != null) {
        //                     if ($subarray[trim($data->{'User Defined'})] == trim($data->{'User Defined Description'})) {
        //                         dd(trim($data->{'User Defined'}));
        //                         if(trim($data->{'User Defined'})=="WARNA <BODY></BODY>"){
        //                             dd("hello");
        //                         }
        //                         $sama = true;
        //                         break;
        //                     }
        //                 }
        //             }
        //             if (!$sama) {
        //                 array_push($array["newparameter"], [
        //                     trim($data->{'User Defined'}) => trim($data->{'User Defined Description'})
        //                 ]);
        //             }
        //             $datatersimpan->parameter = $array;
        //             $datatersimpan->save();
        //         }
        //     }
        //     // dd($newdata);
        // }



        // generate  kit
        $datas = DB::connection('sqlsrv')->table('ITEMKITMAINTENANCE')->get();
        foreach ($datas as $data) {
            $datatersimpan = Masterkit::where('kode_kit', trim($data->{'Item KIT Number'}))->first();
            // dd($datatersimpan);
            if ($datatersimpan == null) {
                $newdata = Masterkit::create([
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
