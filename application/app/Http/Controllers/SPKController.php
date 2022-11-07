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
use Symfony\Polyfill\Ctype\Ctype;

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
        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        foreach ($datas as $data) {
            $datatersimpan = SPK::where('NOSPK', trim($data->{'SPK Number'}))->first();
            if ($datatersimpan == null) {
                $newdata = SPK::create([
                    "NOSPK" => trim($data->{'SPK Number'}),
                    "parameter" =>  [
                        "ModelMobil" => trim($data->{'Merk'}),
                        "TipeMobil" => trim($data->{'Type'}),
                        "TinggiMobil" => "",
                        "newparameter" =>  [
                            [
                                "Newparam" => trim($data->{'User Defined'}),
                                "Component" => [trim($data->{'User Defined Description'})],
                            ],
                        ]
                    ]
                ]);
            } else {
                $terdaftar = false;
                // dd(ctype_space(" "));
                if (trim($data->{'User Defined'}) == "TINGGI BODY") {
                    $array = $datatersimpan->parameter;
                    $array["TinggiMobil"] = trim($data->{'User Defined Description'});
                    $datatersimpan->parameter = $array;
                    $datatersimpan->save();
                } else {
                    $array = $datatersimpan->parameter;
                    $paramterdaftar = false;
                    $index = 0;
                    foreach ($array["newparameter"]  as $subarray) {
                        if (strtoupper($subarray["Newparam"]) == strtoupper(trim($data->{'User Defined'}))) {
                            // dd($subarray["Newparam"] );
                            $paramterdaftar = true;
                            break;
                        }
                        $index++;
                    }
                    if ($paramterdaftar) {
                        $componentterdaftar = false;
                        foreach ($array["newparameter"][0]["Component"] as $isicomponent) {
                            if (strtoupper($isicomponent) == strtoupper(trim($data->{'User Defined Description'}))) {
                                $componentterdaftar = true;
                                break;
                            }
                        }
                        if (!$componentterdaftar) {
                            if(ctype_space($data->{'User Defined Description'}) == false){
                                array_push($array["newparameter"][0]["Component"], trim($data->{'User Defined Description'}));
                                $datatersimpan->parameter = $array;
                                $datatersimpan->save();
                            }

                        }
                    } else {
                        if (ctype_space($data->{'User Defined Description'}) == false) {
                            array_push($array["newparameter"], [
                                "Newparam" => trim($data->{'User Defined'}),
                                "Component" => [trim($data->{'User Defined Description'})],
                            ]);

                            $datatersimpan->parameter = $array;
                            $datatersimpan->save();
                        }
                    }
                    // dd($array["newparameter"]);
                    // $sama = false;
                    // $run = $array["newparameter"][trim($data->{'User Defined'})] ?? null;
                    // if ($run != null) {
                    //     array_push($array["newparameter"][trim($data->{'User Defined'})], trim($data->{'User Defined Description'}));
                    //     $datatersimpan->parameter = $array;
                    //     $datatersimpan->save();
                    // } else {
                    //     array_push($array["newparameter"], [
                    //         trim($data->{'User Defined'}) => [trim($data->{'User Defined Description'})]
                    //     ]);
                    // }
                    // dd($run);
                    // foreach ($array["newparameter"] as $subarray) {
                    //     dd($subarray);
                    //     $run = $subarray[trim($data->{'User Defined'})] ?? null;
                    //     dd($run);
                    //     if ($run != null) {
                    //         if ($subarray[trim($data->{'User Defined'})] == trim($data->{'User Defined Description'})) {
                    //             // dd(trim($data->{'User Defined'}));
                    //             if (trim($data->{'User Defined'}) == "WARNA BODY") {
                    //                 dd("hello");
                    //             }
                    //             $sama = true;
                    //             break;
                    //         }
                    //     }
                    // }
                    // if (!$sama) {
                    //     array_push($array["newparameter"], [
                    //         trim($data->{'User Defined'}) => trim($data->{'User Defined Description'})
                    //     ]);
                    // }
                }
            }
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
