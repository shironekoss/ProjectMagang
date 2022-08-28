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
            $kit = $request->datakit;

            if ($param['kodemobil'] == "") {
                $param['kodemobil'] = "ALL";
            } else {
                $param['kodemobil'] = strtoupper($param['kodemobil']);
            }

            if (count($param['modelbagasi']) == 0) {
                $param['modelbagasi'][0] = "ALL";
            } elseif (count($param['modelbagasi']) == 1) {
                if ($param['modelbagasi'][0] == null) {
                    $param['modelbagasi'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modelbagasi'] as $item) {
                $param['modelbagasi'][$i]=strtoupper($item);
                $i++;
            }

            if (count($param['modelpintu']) == 0) {
                $param['modelpintu'][0] = "ALL";
            } elseif (count($param['modelpintu']) == 1) {
                if ($param['modelpintu'][0] == null) {
                    $param['modelpintu'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modelpintu'] as $item) {
                $param['modelpintu'][$i]=strtoupper($item);
                $i++;
            }

            if (count($param['modelbangku']) == 0) {
                $param['modelbangku'][0] = "ALL";
            } elseif (count($param['modelbangku']) == 1) {
                if ($param['modelbangku'][0] == null) {
                    $param['modelbangku'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modelbangku'] as $item) {
                $param['modelbangku'][$i]=strtoupper($item);
                $i++;
            }

            if (count($param['modelbody']) == 0) {
                $param['modelbody'][0] = "ALL";
            } elseif (count($param['modelbody']) == 1) {
                if ($param['modelbody'][0] == null) {
                    $param['modelbody'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modelbody'] as $item) {
                $param['modelbody'][$i]=strtoupper($item);
                $i++;
            }

            if (count($param['modellampubelakang']) == 0) {
                $param['modellampubelakang'][0] = "ALL";
            } elseif (count($param['modellampubelakang']) == 1) {
                if ($param['modellampubelakang'][0] == null) {
                    $param['modellampubelakang'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modellampubelakang'] as $item) {
                $param['modellampubelakang'][$i]=strtoupper($item);
                $i++;
            }

            if (count($param['modeltangga']) == 0) {
                $param['modeltangga'][0] = "ALL";
            } elseif (count($param['modeltangga']) == 1) {
                if ($param['modeltangga'][0] == null) {
                    $param['modeltangga'][0] = "ALL";
                }
            }
            $i=0;
            foreach ($param['modeltangga'] as $item) {
                $param['modeltangga'][$i]=strtoupper($item);
                $i++;
            }

            $i=0;
            foreach ($param['newparameter'] as $newparam) {
                $param['newparameter'][$i]['newparam']=strtoupper($newparam['newparam']);
                $j=0;
                foreach($newparam['components'] as $parameterbaru){
                    $param['newparameter'][$i]['components'][$j]=strtoupper($parameterbaru);
                    $j++;
                }
                $i++;
            }

  // cek Parameter kosong dan kembar
            function fungsicekkosong(array $cek)
            {
                foreach ($cek as $isicek) {
                    if ($isicek == "" || $isicek == null) {
                        return true;
                    }
                }
            }

            function fungsiceksama(array $cek)
            {
                if (count($cek) !== count(array_unique($cek))) {
                    return true;
                }
            }
            $paramkosong = false;
            $paramsama = false;
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modelbagasi']);
            }
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modelpintu']);
            }
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modelbangku']);
            }
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modelbody']);
            }
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modellampubelakang']);
            }
            if (!$paramkosong) {
                $paramkosong = fungsicekkosong($param['modeltangga']);
            }

            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modelbagasi']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modelpintu']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modelbangku']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modelbody']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modellampubelakang']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['modeltangga']);
            }

            if ($paramkosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 405,
                ]);
            }
            if ($paramsama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 406,
                ]);
            }

            $paramtambahankosong = false;
            foreach ($param['newparameter'] as $newparam) {
                if ($newparam['newparam'] == "" || $newparam['newparam'] == null) {
                    $paramtambahankosong=true;
                    break;
                }
                foreach ($newparam['components'] as $komponen) {
                    if($komponen==""||$komponen==null){
                        $paramtambahankosong=true;
                        break;
                    }
                }
                if($paramtambahankosong){
                    break;
                }
            }
            if ($paramtambahankosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 408,
                ]);
            }

            $paramtambahansama = false;
            foreach ($param['newparameter'] as $newparam) {
                // if (count($newparam['newparam']) !== count(array_unique($newparam['newparam']))){
                //     $paramtambahansama=true;
                //     break;
                // }
                // foreach ($newparam['components'] as $komponen) {
                //     if (count($komponen) !== count(array_unique($komponen))){
                //         $paramtambahansama=true;
                //         break;
                //     }
                // }
                // if($paramtambahansama){
                //     break;
                // }
            }

            if ($paramtambahansama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 409,
                ]);
            }


            // end cek Parameter kosong dan kembar


            // cek master terdaftar belum
            function fungsicekparameterterdaftar(array $array1, array $array2){
                $jumlahkesamaan=0;
                foreach($array1 as $isiarray1){
                    foreach ($array2 as $isiarray2) {
                        if(strtoupper($isiarray1)==strtoupper($isiarray2)){
                            $jumlahkesamaan++;
                            break;
                        }
                    }
                }
                if($jumlahkesamaan==count($array1)){
                    return true;
                }
            }

            $allmaster = Master::all();
            foreach ($allmaster as $master) {
                $saved = $master->parameter;
                $cekkodemobil =false;
                $cekmodelbagasi =false;
                $cekmodelpintu =false;
                $cekmodelbangku =false;
                $cekmodelbody =false;
                $cekmodellampubelakang=false;
                $cekmodeltangga=false;
                $cekstall=false;
                if(strtoupper($saved['kodemobil'])==strtoupper($param['kodemobil'])){
                    $cekkodemobil=true;
                }
                $cekmodelbagasi = fungsicekparameterterdaftar($saved['modelbagasi'],$param['modelbagasi']);
                $cekmodelpintu = fungsicekparameterterdaftar($saved['modelpintu'],$param['modelpintu']);
                $cekmodelbangku = fungsicekparameterterdaftar($saved['modelbangku'],$param['modelbangku']);
                $cekmodelbody = fungsicekparameterterdaftar($saved['modelbody'],$param['modelbody']);
                $cekmodellampubelakang = fungsicekparameterterdaftar($saved['modellampubelakang'],$param['modellampubelakang']);
                $cekmodeltangga = fungsicekparameterterdaftar($saved['modeltangga'],$param['modeltangga']);
                if(strtoupper($saved['stall'])==strtoupper($param['stall'])){
                    $cekstall=true;
                }
                if($cekkodemobil&&$cekmodelbagasi&&$cekmodelpintu&&$cekmodelbangku&&$cekmodelbody&&$cekmodellampubelakang&&$cekmodeltangga&&$cekstall){
                    return response()->json([
                        "success" => true,
                        "statuscode" => 407,
                    ]);
                }
            }
            return response()->json([
                "success" => true,
                "panjang" => count($kit['result']),
                "param" => $param,
                "kit" => $kit,
                "hasil"=>$allmaster[0]->parameter['kodemobil'],
                "cek"=>$param['kodemobil']
            ]);


              //untuk pengecekkan result Head
            // $kosongkit = false;
            // if ($kit['namakit'] == null) {
            //     return response()->json([
            //         "success" => true,
            //         "statuscode" => 402,
            //     ]);
            // } elseif (count($kit['result']) == 0) {
            //     return response()->json([
            //         "success" => true,
            //         "statuscode" => 403,
            //     ]);
            // } elseif (count($kit['result']) > 0) {

            //     foreach ($kit['result'] as $result) {
            //         if ($result['nama_komponen'] == null || $result['qty'] == null || $result['darirak'] == null || $result['kerak'] == null) {
            //             $kosongkit = true;
            //             break;
            //         }
            //     }
            // }
            // if ($kosongkit) {
            //     return response()->json([
            //         "success" => true,
            //         "statuscode" => 404,
            //     ]);
            // } else {
            // return response()->json([
            //     "success" => true,
            //     "panjang" => count($kit['result']),
            //     "param" => $param,
            //     "kit" => $kit
            // ]);
            // }
            //cek komponen sampai sini Tail



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
                "statuscode" => 401,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]); //throw $th;

        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "statuscode" => 401,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]); //throw $th;
        }
    }
}
