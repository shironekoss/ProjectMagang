<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function tambahmaster(Request $request)
    {
        try {
            // $kode = $request->dataparam['kodemobil'];
            // $regex = "/[A-Z]{1,7}+/";
            // $hasil = [];
            // preg_match_all($regex, $kode, $hasil);

            $param = $request->dataparam;
            // $param['kodemobil']=$hasil[0][1];
            $kit = $request->datakit;

            if ($param['kodemobil'] == "") {
                $param['kodemobil'] = "All";
            } else {
                $param['kodemobil'] = strtoupper($param['kodemobil']);
            }

            if (count($param['modelbagasi']) == 0) {
                $param['modelbagasi'][0] = "All";
            } elseif (count($param['modelbagasi']) == 1) {
                if ($param['modelbagasi'][0] == null) {
                    $param['modelbagasi'][0] = "All";
                }
            }

            if (count($param['modelpintu']) == 0) {
                $param['modelpintu'][0] = "All";
            } elseif (count($param['modelpintu']) == 1) {
                if ($param['modelpintu'][0] == null) {
                    $param['modelpintu'][0] = "All";
                }
            }

            if (count($param['modelbangku']) == 0) {
                $param['modelbangku'][0] = "All";
            } elseif (count($param['modelbangku']) == 1) {
                if ($param['modelbangku'][0] == null) {
                    $param['modelbangku'][0] = "All";
                }
            }

            if (count($param['modelbody']) == 0) {
                $param['modelbody'][0] = "All";
            } elseif (count($param['modelbody']) == 1) {
                if ($param['modelbody'][0] == null) {
                    $param['modelbody'][0] = "All";
                }
            }

            if (count($param['modellampubelakang']) == 0) {
                $param['modellampubelakang'][0] = "All";
            } elseif (count($param['modellampubelakang']) == 1) {
                if ($param['modellampubelakang'][0] == null) {
                    $param['modellampubelakang'][0] = "All";
                }
            }

            if (count($param['modelpintu']) == 0) {
                $param['modelpintu'][0] = "All";
            } elseif (count($param['modelpintu']) == 1) {
                if ($param['modelpintu'][0] == null) {
                    $param['modelpintu'][0] = "All";
                }
            }

            if (count($param['modeltangga']) == 0) {
                $param['modeltangga'][0] = "All";
            } elseif (count($param['modeltangga']) == 1) {
                if ($param['modeltangga'][0] == null) {
                    $param['modeltangga'][0] = "All";
                }
            }

            $allmaster = Master::all();
            $sama = false;
            // buat pengecekkan
            // foreach ($allmaster as $master) {
            //     $saved = $master->parameter;
            //     if(strtoupper($saved['kodemobil'])==strtoupper($param['kodemobil'])){
            //         if(strtoupper($saved['stall'])==strtoupper($param['stall'])){
            //             for ($i=0; $i < count($saved['modelbagasi']); $i++) {
            //                 if(strtoupper($saved['modelbagasi'][$i])==strtoupper($param['modelbagasi'][$i])){
            //                     $sama=true;
            //                     break;
            //                 }
            //             }
            //         }
            //     }
            // }


            // $request->dataparam->kodemobil= $hasil[0][1];

            if (!$sama) {
                $Newmaster = Master::create([
                    "kit" => $kit,
                    "parameter" => $param,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => $param,
                    // "data" => $Newmaster
                ]);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "master kit dengan parameter ini sudah terdaftar",
                    // "data" => $Newmaster
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "status" => true,
                "message" => "Kode Mobil Salah",
                // "message" => $allmaster,
            ]);
        }
    }

    public function generatemasterkit(Request $request)
    {

        try {
            $listmasterkit = Masterkit::all();
            $masterkit = new Masterkit();
            foreach ($listmasterkit as $kit) {
                if ($kit->kode_kit == strtoupper($request->param)) {
                    $masterkit = $kit;
                    break;
                }
            }

            return response()->json([
                "status" => true,
                "data" => $request->param,
                "message" => $masterkit,
                "result" => $masterkit,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => true,
                "data" => $request->param,
                "message" => "tidak ditemukan",
                "result" => $masterkit,
            ]); //throw $th;
        }
    }
}
