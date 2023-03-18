<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLController extends Controller
{
    public function getdatakit(Request $request)
    {
        try {
            $masters = Master::all();
            foreach ($masters as $master) {
                $id = $master->_id;
                $kits = $master->Kit;
                $j = 0;
                foreach ($kits as $kit) {
                    $isikits = $kit['IsiKit'];
                    $siteid = $kit['siteID'];
                    $i = 0;
                    foreach ($kit['IsiKit'] as $isikit) {
                        if ($siteid != null) {
                            $available = DB::connection('sqlsrv')
                                ->table('ITEMKITMAINTENANCE')
                                ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
                                ->where('iv00102.RCRDTYPE', '=', "2")
                                ->where(trim('iv00102.LOCNCODE'), '=', trim($siteid))
                                ->where(trim('ITEMKITMAINTENANCE.Component Item Number'), trim($isikit["kode_komponen"]))
                                ->pluck("BINNMBR")
                                ->first();
                            $isikits[$i]["darirak"] = trim($available);
                            $i++;
                        }
                    }
                    $kits[$j]['IsiKit'] = $isikits;
                    $j++;
                }
                $newmaster = Master::where('_id', $id)->first();
                $newmaster->timestamps = false;
                $newmaster->Kit = $kits;
                $newmaster->save();
            }

            //berkaitan pembersihan datamasterkit 
            $hapusdata = Masterkit::truncate();
            DB::connection('sqlsrv')
                ->table('ITEMKITMAINTENANCE')
                ->delete();

            DB::connection('sqlsrv')
                ->statement('insert into ITEMKITMAINTENANCE ([Item KIT Number],[Item KIT Description],[Component Item Number],[Component Item Description],
        [Component Item QTY],[Component Item UofM],[Site ID],[Updated DateTime])
        select [Item KIT Number],[Item KIT Description],[Component Item Number],[Component Item Description],
        [Component Item QTY],[Component Item UofM],[Site ID],getdate() [Updated DateTime]
        from PROGRAMSPK_ITEMKIT');

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
            //update Surat Peintah Kerja
            DB::connection('sqlsrv')
                ->statement('INSERT INTO SURATPERINTAHKERJA
        ([SPK Number], [Merk], [Type], [No Rangka], [No Mesin], [SPK TYPE], [AIR SUSPENSI], [SEMI MONOCOQUE], [UPDATED DATETIME])
        SELECT [SPK Number], [Merk], [Type], [No Rangka], [No Mesin], [SPK TYPE], [AIR SUSPENSI], [SEMI MONOCOQUE], [UPDATED DATETIME]
        FROM PROGRAMSPK_SPK A WHERE NOT EXISTS (SELECT [SPK Number] FROM SURATPERINTAHKERJA B WHERE A.[SPK NUMBER]=B.[SPK NUMBER])');

            DB::connection('sqlsrv')
                ->statement('INSERT INTO SPECIFICATION ([SPK Number],[SPK Type],[Bagian], [User Defined], [User Defined Desc], [Air Suspensi], [Semi Monocoque], [UPDATED DATETIME])
                SELECT [SPK Number],[SPK Type],[Bagian], [User Defined], [User Defined Desc], [Air Suspensi], [Semi Monocoque], GETDATE() [UPDATE DATETIME] FROM PROGRAMSPK_specification E where not exists 
                (select [spk number] from SPECIFICATION f where e.[spk number]=f.[spk number])');

            $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
                ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
                ->get();
            foreach ($datas as $data) {
                $datatersimpan = SPK::where('NOSPK', trim($data->{'SPK Number'}))->first();
                if ($datatersimpan == null) {
                    if (strtoupper(trim($data->{'User Defined'})) == "TINGGI BODY") {
                        $newdata = SPK::create([
                            "NOSPK" => trim($data->{'SPK Number'}),
                            "Tipe" => trim($data->{'SPK Type'}),
                            "AirSuspensi" => trim($data->{'Air Suspensi'}),
                            "Semi_Monocoque" => trim($data->{'Semi Monocoque'}),
                            "No_Rangka" => trim($data->{'No Rangka'}),
                            "No_Mesin" => trim($data->{'No Mesin'}),
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
                            "Tipe" => trim($data->{'SPK Type'}),
                            "AirSuspensi" => trim($data->{'Air Suspensi'}),
                            "Semi_Monocoque" => trim($data->{'Semi Monocoque'}),
                            "No_Rangka" => trim($data->{'No Rangka'}),
                            "No_Mesin" => trim($data->{'No Mesin'}),
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
                } else {
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
                "error" => $th->getMessage(),
                'message' => "Gagal tarik data SPK",
            ]);
        }
    }
}
