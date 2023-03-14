<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\Master;
use App\Models\Masterkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\String_;
use PhpParser\Node\Stmt\Foreach_;

class MasterController extends Controller
{
    public function listmaster()
    {
        $masters = Master::all()->sortByDesc('updated_at');
        $data = [];
        foreach ($masters as $master) {
            foreach ($master["Kit"] as $kit) {
                array_push($data, [
                    "NamaKit" => $kit['NamaKit'],
                    "Kodekit" => $kit['Kodekit'],
                    "_id" => $master['_id'],
                    "updated_at" => $master['updated_at'],
                ]);
            }
        }
        return response()->json([
            "statusresponse" => 200,
            "data" => $data
        ]);
    }

    public function carimaster($id)
    {
        $master = Master::find($id);
        return $master;
    }

    public function carikoderak(Request $request)
    {
        $datas = $request->value;
        $site = $request->site;
        $i = 0;
        foreach ($datas as $data) {
            $available = DB::connection('sqlsrv')
                ->table('ITEMKITMAINTENANCE')
                ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
                ->where('iv00102.RCRDTYPE', '=', "2")
                ->where('iv00102.LOCNCODE', '=', $site)
                ->where('ITEMKITMAINTENANCE.Component Item Description', $data["nama_komponen"])
                ->pluck("BINNMBR")
                ->first();
            $datas[$i]["darirak"] = trim($available);
            $i++;
        }


        // "darirak"
        return response()->json([
            "data" => $datas
        ]);
    }

    public function hapusmaster(Request $request)
    {
        try {
            $saved = Master::where('_id', $request->id)->first();
            $saved->delete();
            return response()->json([
                "statusresponse" => 200,
                'message' => " Berhasil Menghapus",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Gagal menghapus"
            ]);
        }
    }

    public function tambahmaster(Request $request)
    {
        try {
            $param = $request->dataparam;
            $kit = $request->datakit;

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
                if (count($cek) == 0) {
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
                $paramkosong = FungsicekKosong($param['Departemen']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsicekKosong($param['Stall']);
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
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['ModelMobil']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['TinggiMobil']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['Departemen']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['Stall']);
            }
            if (!$paramsama) {
                $paramsama = fungsiceksama($param['Stock']);
            }

            if ($paramsama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 402,
                ]);
            }

            //untuk pengecekkan tambahan
            $paramtambahankosong = false;
            foreach ($param['NewParameter'] as $newparam) {
                if ($newparam['Newparam'] == "" || $newparam['Newparam'] == null) {
                    $paramtambahankosong = true;
                    break;
                }
                foreach ($newparam['Component'] as $komponen) {
                    if ($komponen == "" || $komponen == null) {
                        $paramtambahankosong = true;
                        break;
                    }
                }
                if ($paramtambahankosong) {
                    break;
                }
            }
            if ($paramtambahankosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 403,
                ]);
            }

            //untuk pengecekkan paramtambahansama
            $paramtambahansama = false;
            $judulparamtambahankembar = array();
            foreach ($param['NewParameter'] as $newparam) {
                array_push($judulparamtambahankembar, $newparam['Newparam']);
                if (count($newparam['Component']) !== count(array_unique($newparam['Component']))) {
                    $paramtambahansama = true;
                    break;
                }
            }
            if (count($judulparamtambahankembar) !== count(array_unique($judulparamtambahankembar))) {
                $paramtambahansama = true;
            }
            if ($paramtambahansama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 404,
                ]);
            }

            //  Cek parameter sama atau sudah terdaftar
            function fungsicekparameterterdaftar(array $array1, array $array2)
            {
                $jumlahkesamaan = 0;
                foreach ($array2 as $isiarray2) {
                    foreach ($array1 as $isiarray1) {
                        if (strtoupper($isiarray1) == strtoupper($isiarray2)) {
                            $jumlahkesamaan++;
                            break;
                        }
                    }
                }
                if ($jumlahkesamaan == count($array1) && $jumlahkesamaan == count($array2)) {
                    return true;
                } else {
                    return false;
                }
            }
            $allmaster = Master::all();
            foreach ($allmaster as $master) {
                $saved = $master->Parameter;
                $cekTipeMobil = false;
                $cekModelMobil = false;
                $cekTinggiMobil = false;
                $cekDepartemen = false;
                $cekstall = false;
                $cekStock = false;
                $cekAdditionaParameter = false;
                $cekTipeMobil =  fungsicekparameterterdaftar($saved['TipeMobil'], $param['TipeMobil']);
                $cekModelMobil = fungsicekparameterterdaftar($saved['ModelMobil'], $param['ModelMobil']);
                $cekTinggiMobil = fungsicekparameterterdaftar($saved['TinggiMobil'], $param['TinggiMobil']);
                $cekDepartemen = fungsicekparameterterdaftar($saved['Departemen'], $param['Departemen']);
                $cekstall = fungsicekparameterterdaftar($saved['Stall'], $param['Stall']);
                if (count($param['Stock']) == 0 && count($saved['Stock']) == 0) {
                    $cekStock = true;
                } else {
                    $cekStock = fungsicekparameterterdaftar($saved['Stock'], $param['Stock']);
                }

                if (count($param['NewParameter']) == 0 && count($saved['NewParameter']) == 0) {
                    $cekAdditionaParameter = true;
                } elseif (count($saved['NewParameter']) == count($param['NewParameter'])) {
                    $judulparamsama = 0;
                    foreach ($saved['NewParameter'] as $item) {
                        foreach ($param['NewParameter'] as $item2) {
                            if (strtoupper($item['Newparam']) == strtoupper($item2['Newparam'])) {
                                $komponensama = 0;
                                foreach ($item['Component'] as $komponendatabase) {
                                    foreach ($item2['Component'] as $komponennew) {
                                        if (strtoupper($komponendatabase) == strtoupper($komponennew)) {
                                            $komponensama++;
                                        }
                                    }
                                }
                                if ($komponensama == count($item2['Component']) && $komponensama == count($item['Component'])) {
                                    $judulparamsama++;
                                }
                            }
                        }
                    }
                    if ($judulparamsama == count($saved['NewParameter'])) {
                        $cekAdditionaParameter = true;
                    }
                }
                if ($cekTipeMobil && $cekModelMobil && $cekTinggiMobil && $cekDepartemen && $cekStock && $cekstall && $cekAdditionaParameter) {
                    return response()->json([
                        "success" => true,
                        "statuscode" => 406,
                    ]);
                }
            }


            //   untuk pengecekkan result
            $kosongkit = false;
            if (count($kit) > 0) {
                foreach ($kit as $subkit) {
                    $subkit["NamaKit"] = ucwords($subkit["NamaKit"]);
                    if (count($subkit['IsiKit']) > 0) {
                        $j = 0;
                        foreach ($subkit['IsiKit'] as $komponen) {
                            $komponen[$j]['nama_komponen'] = ucwords($komponen['nama_komponen']);
                            $j++;
                        }
                    }
                    foreach ($subkit['IsiKit'] as $komponen) {
                        if ($komponen['nama_komponen'] == null || $komponen['qty'] == null) {
                            $kosongkit = true;
                            break;
                        }
                    }
                }
            } else {
                return response()->json([
                    "success" => true,
                    "statuscode" => 405,
                ]);
            }
            if ($kosongkit) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 408,
                ]);
            }

            // insert data
            $Newmaster = Master::create([
                "Kit" => $kit,
                "Parameter" => $param,
            ]);
            return response()->json([
                "success" => true,
                "statuscode" => 200,
                "kit" => $kit
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "statuscode" => 410,
                "message" => "Response salah",
                // "message" => $allmaster,
            ]);
        }
    }

    public function updatemaster(Request $request)
    {
        try {
            $param = $request->dataparam;
            $kit = $request->datakit;

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

            function FungsiUpdatecekKosong(array $cek)
            {
                if (count($cek) == 0) {
                    return true;
                }
            }

            $paramkosong = false;
            if (!$paramkosong) {
                $paramkosong = FungsiUpdatecekKosong($param['TipeMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsiUpdatecekKosong($param['ModelMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsiUpdatecekKosong($param['TinggiMobil']);
            }
            if (!$paramkosong) {
                $paramkosong = FungsiUpdatecekKosong($param['Departemen']);
            }
            if (!$paramkosong) {
                $paramsama = FungsiUpdatecekKosong($param['Stall']);
            }
            if (!$paramkosong) {
                $paramsama = FungsiUpdatecekKosong($param['Stock']);
            }

            if ($paramkosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 401,
                ]);
            }

            function fungsiupdateceksama(array $cek)
            {
                if (count($cek) !== count(array_unique($cek))) {
                    return true;
                }
            }

            $paramsama = false;
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['TipeMobil']);
            }
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['ModelMobil']);
            }
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['TinggiMobil']);
            }
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['Departemen']);
            }
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['Stall']);
            }
            if (!$paramsama) {
                $paramsama = fungsiupdateceksama($param['Stock']);
            }

            if ($paramsama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 402,
                ]);
            }

            //untuk pengecekkan tambahan
            $paramtambahankosong = false;
            foreach ($param['NewParameter'] as $newparam) {
                if ($newparam['Newparam'] == "" || $newparam['Newparam'] == null) {
                    $paramtambahankosong = true;
                    break;
                }
                foreach ($newparam['Component'] as $komponen) {
                    if ($komponen == "" || $komponen == null) {
                        $paramtambahankosong = true;
                        break;
                    }
                }
                if ($paramtambahankosong) {
                    break;
                }
            }
            if ($paramtambahankosong) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 403,
                ]);
            }

            //untuk pengecekkan paramtambahansama
            $paramtambahansama = false;
            $judulparamtambahankembar = array();
            foreach ($param['NewParameter'] as $newparam) {
                array_push($judulparamtambahankembar, $newparam['Newparam']);
                if (count($newparam['Component']) !== count(array_unique($newparam['Component']))) {
                    $paramtambahansama = true;
                    break;
                }
            }
            if (count($judulparamtambahankembar) !== count(array_unique($judulparamtambahankembar))) {
                $paramtambahansama = true;
            }
            if ($paramtambahansama) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 404,
                ]);
            }


            function fungsicekparameterupdatetambahan(array $array1, array $array2)
            {
                $jumlahkesamaan = 0;
                foreach ($array2 as $isiarray2) {
                    foreach ($array1 as $isiarray1) {
                        if (strtoupper($isiarray1) == strtoupper($isiarray2)) {
                            $jumlahkesamaan++;
                            break;
                        }
                    }
                }
                if ($jumlahkesamaan == count($array1) && $jumlahkesamaan == count($array2)) {
                    return true;
                }
                else{
                    return false;
                }
                
            }
            $allmaster = Master::where('_id', '!=', $request->id)->get();
            foreach ($allmaster as $master) {
                $saved = $master->Parameter;
                $cekTipeMobil = false;
                $cekModelMobil = false;
                $cekTinggiMobil = false;
                $cekDepartemen = false;
                $cekstall = false;
                $cekStock = false;
                $cekAdditionaParameter = false;
                $cekTipeMobil = fungsicekparameterupdatetambahan($saved['TipeMobil'], $param['TipeMobil']);
                $cekModelMobil = fungsicekparameterupdatetambahan($saved['ModelMobil'], $param['ModelMobil']);
                $cekTinggiMobil = fungsicekparameterupdatetambahan($saved['TinggiMobil'], $param['TinggiMobil']);
                $cekDepartemen = fungsicekparameterupdatetambahan($saved['Departemen'], $param['Departemen']);
                $cekstall = fungsicekparameterupdatetambahan($saved['Stall'], $param['Stall']);
                if (count($param['Stock']) == 0 && count($saved['Stock']) == 0) {
                    $cekStock = true;
                } else {
                    $cekStock = fungsicekparameterupdatetambahan($saved['Stock'], $param['Stock']);
                }
                if (count($param['NewParameter']) == 0 && count($saved['NewParameter']) == 0) {
                    $cekAdditionaParameter = true;
                } elseif (count($saved['NewParameter']) == count($param['NewParameter'])) {
                    $judulparamsama = 0;
                    foreach ($saved['NewParameter'] as $item) {
                        foreach ($param['NewParameter'] as $item2) {
                            if (strtoupper($item['Newparam']) == strtoupper($item2['Newparam'])) {
                                $komponensama = 0;
                                foreach ($item['Component'] as $komponendatabase) {
                                    foreach ($item2['Component'] as $komponennew) {
                                        if (strtoupper($komponendatabase) == strtoupper($komponennew)) {
                                            $komponensama++;
                                        }
                                    }
                                }
                                if ($komponensama == count($item2['Component']) && $komponensama == count($item['Component'])) {
                                    $judulparamsama++;
                                }
                            }
                        }
                    }
                    if ($judulparamsama == count($saved['NewParameter'])) {
                        $cekAdditionaParameter = true;
                    }
                }
                if ($cekTipeMobil && $cekModelMobil && $cekTinggiMobil && $cekDepartemen && $cekStock && $cekAdditionaParameter && $cekstall) {
                    return response()->json([
                        "success" => true,
                        "statuscode" => 406,
                    ]);
                }
            }
            //   untuk pengecekkan result
            $kosongkit = false;
            if (count($kit) > 0) {
                foreach ($kit as $subkit) {
                    $subkit["NamaKit"] = ucwords($subkit["NamaKit"]);
                    if (count($subkit['IsiKit']) > 0) {
                        $j = 0;
                        foreach ($subkit['IsiKit'] as $komponen) {
                            $komponen[$j]['nama_komponen'] = ucwords($komponen['nama_komponen']);
                            $j++;
                        }
                    }
                    foreach ($subkit['IsiKit'] as $komponen) {
                        // if ($komponen['nama_komponen'] == null || $komponen['qty'] == null || $komponen['darirak'] == null || $komponen['kerak'] == null) {
                        //     $kosongkit = true;
                        //     break;
                        // }
                        if ($komponen['nama_komponen'] == null || $komponen['qty'] == null) {
                            $kosongkit = true;
                            break;
                        }
                    }
                }
            } else {
                return response()->json([
                    "success" => true,
                    "statuscode" => 405,
                ]);
            }
            if ($kosongkit) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 408,
                ]);
            }

            // insert data
            $newupdate = Master::find($request->id);
            $newupdate->Kit = $kit;
            $newupdate->Parameter = $param;
            $newupdate->save();

            return response()->json([
                "success" => true,
                "statuscode" => 200,
                "kit" => $allmaster
            ]);
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
            if ($request->mode == "tambah") {
                $kitsudahada = $this->checksudahterpakai($request->param);
            } else if ($request->mode == "update") {
                $kitsudahada = $this->checksudahterpakaiupdate($request->param, $request->id);
            }
            if ($kitsudahada) {
                return response()->json([
                    "success" => true,
                    "statuscode" => 400,
                    "data" => $request->param,
                    "message" => "sudah terdaftar",
                ]);
            } else {
                $masterkit = new Masterkit();
                foreach ($listmasterkit as $kit) {
                    if (strtoupper($kit->kode_kit) == strtoupper($request->param)) {
                        $masterkit = $kit;
                        return response()->json([
                            "success" => true,
                            "statuscode" => 201,
                            "data" =>  strtoupper($request->param),
                            "message" => $masterkit,
                            "result" => $masterkit,
                            "hasil" => $kitsudahada
                        ]);
                    }
                }
            }
            return response()->json([
                "success" => true,
                "statuscode" => 400,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "statuscode" => 400,
                "data" => $request->param,
                "message" => "tidak ditemukan",
            ]); //throw $th;
        }
    }

    public function checksudahterpakai(String $kode_kit)
    {
        $masterterdaftar = Master::all();
        if (count($masterterdaftar) > 0) {
            foreach ($masterterdaftar as $datamaster) {
                foreach ($datamaster["Kit"] as $kit) {
                    if (strtoupper($kit["Kodekit"]) == strtoupper($kode_kit)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function checksudahterpakaiupdate(String $kode_kit, String $id)
    {
        $masterterdaftar =  Master::where('_id', "!=", $id)->get();
        if (count($masterterdaftar) > 0) {
            foreach ($masterterdaftar as $datamaster) {
                foreach ($datamaster["Kit"] as $kit) {
                    if (strtoupper($kit["Kodekit"]) == strtoupper($kode_kit)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
