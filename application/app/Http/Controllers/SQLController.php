<?php

namespace App\Http\Controllers;

use App\Models\Masterkit;
use App\Models\SPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLController extends Controller
{
    public function getdatakit(Request $request)
    {
        try {
            $hapusdata = Masterkit::truncate();
            $datas = DB::connection('sqlsrv')->table('ITEMKITMAINTENANCE')->get();
            foreach ($datas as $data) {
                $datatersimpan = Masterkit::where('kode_kit', trim($data->{'Item KIT Number'}))->first();
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
                                if ($saved['nama_komponen'] != trim($data->{'Component Item Description'}) || $saved['qty'] != trim($data->{'Component Item QTY'}) || $saved['Satuan'] != trim($data->{'Component Item UofM'})) {
                                    $new = array(
                                        'kode_komponen' => trim($data->{'Component Item Number'}),
                                        'nama_komponen' => trim($data->{'Component Item Description'}),
                                        'qty' =>   trim($data->{'Component Item QTY'}),
                                        'Satuan' => trim($data->{'Component Item UofM'}),
                                    );
                                    $array[$index] = $new;
                                    $datatersimpan->komponen = $array;
                                    $datatersimpan->save();
                                }
                            }
                            $index++;
                        }
                    }
                }
            }
            return response()->json([
                "statusresponse" => 200,
                'message' => "Kit Berhasil Ditarik",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                'message' => "Gagal tarik data kit",
            ]);
        }
    }
    public function resetdata()
    {
        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();

        $database = SPK::all();
        $result = [];
        foreach ($database as $datab) {
            foreach ($datas as $data) {
                if (strtoupper($datab["NOSPK"]) == strtoupper(trim($data->{'SPK Number'}))) {
                    $resetdata = [
                        "ModelMobil" => "",
                        "TipeMobil" => "",
                        "TinggiMobil" => "",
                        "newparameter" =>  [],
                    ];
                    $datab["parameter"] = $resetdata;
                    $datab->save();
                    break;
                }
            }
        }
    }

    public function getdataspk()
    {
        try {
            $this->resetdata();
            $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
                ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
                ->get();
            foreach ($datas as $data) {
                $datatersimpan = SPK::where('NOSPK', trim($data->{'SPK Number'}))->first();
                if ($datatersimpan == null) {
                    if (strtoupper(trim($data->{'User Defined'})) == "TINGGI BODY") {
                        $newdata = SPK::create([
                            "NOSPK" => trim($data->{'SPK Number'}),
                            "Tipe"=>trim($data->{'SPK Type'}),
                            "AirSuspensi"=>trim($data->{'Air Suspensi'}),
                            "Semi_Monocoque"=>trim($data->{'Semi Monocoque'}),
                            "No_Rangka"=>trim($data->{'No Rangka'}),
                            "No_Mesin"=>trim($data->{'No Mesin'}),
                            "parameter" =>  [
                                "ModelMobil" => trim($data->{'Merk'}),
                                "TipeMobil" => trim($data->{'Type'}),
                                "TinggiMobil" => trim($data->{'User Defined Desc'}),
                                "newparameter" =>  [],
                            ],
                        ]);
                    } else {
                        $newdata = SPK::create([
                            "NOSPK" => trim($data->{'SPK Number'}),
                            "Tipe"=>trim($data->{'SPK Type'}),
                            "AirSuspensi"=>trim($data->{'Air Suspensi'}),
                            "Semi_Monocoque"=>trim($data->{'Semi Monocoque'}),
                            "No_Rangka"=>trim($data->{'No Rangka'}),
                            "No_Mesin"=>trim($data->{'No Mesin'}),
                            "parameter" =>  [
                                "ModelMobil" => trim($data->{'Merk'}),
                                "TipeMobil" => trim($data->{'Type'}),
                                "TinggiMobil" => "",
                                "newparameter" =>  [
                                    [
                                        "Newparam" => trim($data->{'User Defined'}),
                                        "Component" => [trim($data->{'User Defined Desc'})],
                                    ],
                                ]
                            ]
                        ]);
                    }
                }
                else {
                    $array = $datatersimpan->parameter;
                    $array["ModelMobil"] = trim($data->{'Merk'});
                    $array["TipeMobil"] = trim($data->{'Type'});
                    $terdaftar = false;
                    if (trim($data->{'User Defined'}) == "TINGGI BODY") {
                        $array["TinggiMobil"] = trim($data->{'User Defined Desc'});
                        $datatersimpan->parameter = $array;
                        $datatersimpan->save();
                    } else {
                        $paramterdaftar = false;
                        $index = 0;
                        foreach ($array["newparameter"]  as $subarray) {
                            if (strtoupper($subarray["Newparam"]) == strtoupper(trim($data->{'User Defined'}))) {
                                $paramterdaftar = true;
                                break;
                            }
                            $index++;
                        }
                        if ($paramterdaftar) {
                            $componentterdaftar = false;
                            foreach ($array["newparameter"][0]["Component"] as $isicomponent) {
                                if (strtoupper($isicomponent) == strtoupper(trim($data->{'User Defined Desc'}))) {
                                    $componentterdaftar = true;
                                    break;
                                }
                            }
                            if (!$componentterdaftar) {
                                if (ctype_space($data->{'User Defined Desc'}) == false) {
                                    array_push($array["newparameter"][0]["Component"], trim($data->{'User Defined Desc'}));
                                    $datatersimpan->parameter = $array;
                                    $datatersimpan->save();
                                }
                            }
                        } else {
                            if (ctype_space($data->{'User Defined Desc'}) == false) {
                                array_push($array["newparameter"], [
                                    "Newparam" => trim($data->{'User Defined'}),
                                    "Component" => [trim($data->{'User Defined Desc'})],
                                ]);

                                $datatersimpan->parameter = $array;
                                $datatersimpan->save();
                            }
                        }
                    }
                }
            }
            return response()->json([
                "statusresponse" => 200,
                'message' => "Data SPK sukses ditarik",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "error"=>$th->getMessage(),
                'message' => "Gagal tarik data SPK",
            ]);
        }
    }
}
