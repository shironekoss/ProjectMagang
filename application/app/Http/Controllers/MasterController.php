<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\Master;
use App\Models\Masterkit;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function tambahmaster(Request $request)
    {
        try {

            $param = $request->dataparam;
            // $kit = $request->datakit;

            //buat word menarik
            $i = 0;
            foreach ($param['TipeMobil'] as $item) {
                $param['TipeMobil'][$i] = ucwords($item);
                $i++;
            }
            $i = 0;
            foreach ($param['ModelMobil'] as $item) {
                $param['ModelMobil'][$i] = ucwords($item);
                $i++;
            }
            $i = 0;
            foreach ($param['TinggiMobil'] as $item) {
                $param['TinggiMobil'][$i] = ucwords($item);
                $i++;
            }
            $i = 0;
            foreach ($param['Departemen'] as $item) {
                $param['Departemen'][$i] = ucwords($item);
                $i++;
            }
            $i = 0;
            foreach ($param['Stock'] as $item) {
                $param['Stock'][$i] = ucwords($item);
                $i++;
            }
            $i = 0;
            foreach ($param['NewParameter'] as $newparam) {
                $param['NewParameter'][$i]['Newparam'] = ucwords($newparam['Newparam']);
                $j = 0;
                foreach ($newparam['Component'] as $parameterbaru) {
                    $param['NewParameter'][$i]['Component'][$j] = ucwords($parameterbaru);
                    $j++;
                }
                $i++;
            }

            //cek parameter ada yg kosong
            function FungsicekKosong(array $cek)
            {
                if(count($cek)==0){
                    return true;
                }
            }

            $paramkosong = false;
            if (!$paramkosong) {
                $paramkosong = FungsicekKosong($param['TipeMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsicekKosong($param['ModelMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsicekKosong($param['TinggiMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsicekKosong($param['Stock']);
            }

            if ($paramkosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 401,
                ]);
            }

            // cek Parameter kembar
            function fungsiceksama(array $cek)
            {
                if (count($cek) !== count(array_unique($cek))) {
                    return true;
                }
            }

            $paramsama = false;

            if (!$paramsama) {
                $paramsama = fungsiceksama($param['TipeMobil']);
            }if (!$paramsama) {
                $paramsama = fungsiceksama($param['ModelMobil']);
            }if (!$paramsama) {
                $paramsama = fungsiceksama($param['TinggiMobil']);
            }if (!$paramsama) {
                $paramsama = fungsiceksama($param['Departemen']);
            }if (!$paramsama) {
                $paramsama = fungsiceksama($param['Departemen']);
            }

            if ($paramsama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 406,
                ]);
            }

            //untuk pengecekkan tambahan
             // $paramtambahankosong = false;
            // foreach ($param['newparameter'] as $newparam) {
            //     if ($newparam['newparam'] == "" || $newparam['newparam'] == null) {
            //         $paramtambahankosong = true;
            //         break;
            //     }
            //     foreach ($newparam['components'] as $komponen) {
            //         if ($komponen == "" || $komponen == null) {
            //             $paramtambahankosong = true;
            //             break;
            //         }
            //     }
            //     if ($paramtambahankosong) {
            //         break;
            //     }
            // }
            // if ($paramtambahankosong) {
            //     return response()->json([
            //         "success" => true,
            //         "statuscode" => 408,
            //     ]);
            // }

            return response()->json([
                    "success" => true,
                    "statuscode" => 200,
                    "y"=>$param['TipeMobil']
                ]);


           

            // $paramtambahansama = false;
            // $judulparamtambahankembar = array();
            // foreach ($param['newparameter'] as $newparam) {
            //     array_push($judulparamtambahankembar, $newparam['newparam']);
            //     if (count($newparam['components']) !== count(array_unique($newparam['components']))) {
            //         $paramtambahansama = true;
            //         break;
            //     }
            // }

            // if (count($judulparamtambahankembar) !== count(array_unique($judulparamtambahankembar))) {
            //     $paramtambahansama = true;
            // }

            // if ($paramtambahansama) {
            //     return response()->json([
            //         "success" => true,
            //         "statuscode" => 409,
            //     ]);
            // }

        //     function fungsicekparameterterdaftar(array $array1, array $array2)
        //     {
        //         $jumlahkesamaan = 0;
        //         foreach ($array2 as $isiarray2) {
        //             foreach ($array1 as $isiarray1) {
        //                 if (strtoupper($isiarray1) == strtoupper($isiarray2)) {
        //                     $jumlahkesamaan++;
        //                     break;
        //                 }
        //             }
        //         }
        //         if ($jumlahkesamaan > 0) {
        //             return true;
        //         }
        //     }

        //     $allmaster = Master::all();
        //     foreach ($allmaster as $master) {
        //         $saved = $master->parameter;
        //         $cekkodemobil = false;
        //         $cekmodelbagasi = false;
        //         $cekmodelpintu = false;
        //         $cekmodelbangku = false;
        //         $cekmodelbody = false;
        //         $cekmodellampubelakang = false;
        //         $cekmodeltangga = false;
        //         $cekstall = false;
        //         $cekadditionalparameter = false;
        //         if (strtoupper($saved['kodemobil']) == strtoupper($param['kodemobil'])) {
        //             $cekkodemobil = true;
        //         }
        //         $cekmodelbagasi = fungsicekparameterterdaftar($saved['modelbagasi'], $param['modelbagasi']);
        //         $cekmodelpintu = fungsicekparameterterdaftar($saved['modelpintu'], $param['modelpintu']);
        //         $cekmodelbangku = fungsicekparameterterdaftar($saved['modelbangku'], $param['modelbangku']);
        //         $cekmodelbody = fungsicekparameterterdaftar($saved['modelbody'], $param['modelbody']);
        //         $cekmodellampubelakang = fungsicekparameterterdaftar($saved['modellampubelakang'], $param['modellampubelakang']);
        //         $cekmodeltangga = fungsicekparameterterdaftar($saved['modeltangga'], $param['modeltangga']);
        //         if (strtoupper($saved['stall']) == strtoupper($param['stall'])) {
        //             $cekstall = true;
        //         }
        //         if (count($param['newparameter']) == 0) {
        //             $cekadditionalparameter = true;
        //         } elseif (count($saved['newparameter']) == count($param['newparameter'])) {
        //             $judulparamsama = 0;
        //             foreach ($saved['newparameter'] as $item) {
        //                 foreach ($param['newparameter'] as $item2) {
        //                     if (strtoupper($item['newparam']) == strtoupper($item2['newparam'])) {
        //                         $komponensama = 0;
        //                         foreach ($item['components'] as $komponendatabase) {
        //                             foreach ($item2['components'] as $komponennew) {
        //                                 if (strtoupper($komponendatabase) == strtoupper($komponennew)) {
        //                                     $komponensama++;
        //                                 }
        //                             }
        //                         }
        //                         if ($komponensama == count($item2['components'])) {
        //                             $judulparamsama++;
        //                         }
        //                     }
        //                 }
        //                 if ($judulparamsama == count($saved['newparameter'])) {
        //                     $cekadditionalparameter = true;
        //                     // return response()->json([
        //                     //     "success" => true,
        //                     //     "statuscode" => 411,
        //                     // ]);
        //                 }
        //             }
        //         }
        //         if ($cekkodemobil && $cekmodelbagasi && $cekmodelpintu && $cekmodelbangku && $cekmodelbody && $cekmodellampubelakang && $cekmodeltangga && $cekstall && $cekadditionalparameter) {
        //             return response()->json([
        //                 "success" => true,
        //                 "statuscode" => 407,
        //             ]);
        //         }
        //     }
        //     //   untuk pengecekkan result Head
        //     $kosongkit = false;
        //     if ($kit['namakit'] != null) {
        //         $kit['namakit'] = strtoupper($kit['namakit']);
        //     }
        //     if (count($kit['result']) > 0) {
        //         $j = 0;
        //         foreach ($kit['result'] as $result) {
        //             $kit['result'][$j]['nama_komponen'] = strtoupper($result['nama_komponen']);
        //             $j++;
        //         }
        //     }
        //     if ($kit['namakit'] == null) {
        //         return response()->json([
        //             "success" => true,
        //             "statuscode" => 402,
        //         ]);
        //     } elseif (count($kit['result']) == 0) {
        //         return response()->json([
        //             "success" => true,
        //             "statuscode" => 403,
        //         ]);
        //     } elseif (count($kit['result']) > 0) {

        //         foreach ($kit['result'] as $result) {
        //             if ($result['nama_komponen'] == null || $result['qty'] == null || $result['darirak'] == null || $result['kerak'] == null) {
        //                 $kosongkit = true;
        //                 break;
        //             }
        //         }
        //     }
        //     if ($kosongkit) {
        //         return response()->json([
        //             "success" => true,
        //             "statuscode" => 404,
        //         ]);
        //     }
        //     // cek komponen sampai sini Tail

        //     // insert data
        //     $Newmaster = Master::create([
        //         "kit" => $kit,
        //         "parameter" => $param,
        //     ]);
        //     return response()->json([
        //         "success" => true,
        //         "statuscode" => 200,
        //         "kit" => $kit
        //     ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "statuscode" => 410,
                "message" => "Response salah",
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
                    return response()->json([
                        "success" => true,
                        "statuscode" => 201,
                        "data" => $request->param,
                        "message" => $masterkit,
                        "result" => $masterkit,
                    ]);
                }
            }
            return response()->json([
                "success" => true,
                "statuscode" => 400,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]); //throw $th;

        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "statuscode" => 400,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]); //throw $th;
        }
    }
}
