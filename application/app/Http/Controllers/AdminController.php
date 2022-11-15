<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\SPK;
use App\Models\Stall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Nette\Utils\Strings;

class AdminController extends Controller
{
    public function getdataspk()
    {
        $listspk = SPK::all();
        return $listspk;
    }
    public function getdatatable()
    {
        $listdata = SavedConversionResult::all();
        return $listdata;
    }

    public function hapusdatatable(Request $request)
    {
        try {
            $saved = SavedConversionResult::where('_id', $request->id)->first();
            $saved->delete();
            return response()->json([
                "success" => true,
                "status" => 200,
                "pesan" => $saved,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        }
    }

    public function getlistallparameterinput(Request $request)
    {
        $param = $request->Parameterdeps;
        $result = [];
        $stalls = Stall::where('NamaDepartemen', $param)->get();
        foreach ($stalls as $stall) {
            array_push($result, [
                'Namastall' => $stall->NamaStall,
                'Jumlahstall' => $stall->JumlahStall
            ]);
        }
        return response()->json([
            "statusresponse" => 200,
            "result" => $result
        ]);
    }

    public function konversikomponen()
    {
        $saved = SavedConversionResult::all();
        $master = Master::all();
        $messages = [];
        $results = [];
        $result = [];
        foreach ($saved as $item1) {
            //errors check
            $errors = [];
            $errorModelMobil = true;
            $errorTipeMobil = true;
            $errorTinggiMobil = true;
            $errorDepartemen = true;
            $errorStall = true;
            $errornewparam = true;
            if ($item1["NOSPK"] == "STOCK") {
                $i = 0;
                foreach ($master as $item2) {
                    foreach ($item2["Parameter"]["Stock"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($item1["stall"])) {
                            array_push($result, $item2["Kit"]);
                            $i++;
                            break;
                        }
                    }
                }
                if ($i > 0) {
                    array_push($results, [
                        'kit' => $result,
                        'NoSPK' => $item1->NOSPK,
                    ]);
                    $item1["status"] = "berhasil";
                    $item1["errors"] = [];
                    $item1->save();
                } else {
                    $item1["status"] = "Pending";
                    $item1["errors"] = ["Stall Belum Terdaftar"];
                    $item1->save();
                }
            } else {
                $i = 0;
                foreach ($master as $item2) {
                    $data = SPK::where('NOSPK', $item1["NOSPK"])->first();
                    $ModelMobilterdaftar = false;
                    $TinggiMobilterdaftar = false;
                    $TipeMobilTerdaftar = false;
                    $DepartemenTerdaftar = false;
                    $StallTerdaftar = false;
                    $newparameterTerdaftar = false;
                    foreach ($item2["Parameter"]["ModelMobil"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($data["parameter"]["ModelMobil"])) {
                            $ModelMobilterdaftar = true;
                            $errorModelMobil = false;
                            break;
                        }
                    }
                    foreach ($item2["Parameter"]["TinggiMobil"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($data["parameter"]["TinggiMobil"])) {
                            $TinggiMobilterdaftar = true;
                            $errorTinggiMobil = false;
                            break;
                        }
                    }
                    foreach ($item2["Parameter"]["TipeMobil"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($data["parameter"]["TipeMobil"])) {
                            $TipeMobilTerdaftar = true;
                            $errorTipeMobil = false;
                            break;
                        }
                    }
                    foreach ($item2["Parameter"]["Departemen"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($item1["Departemen"])) {
                            $DepartemenTerdaftar = true;
                            $errorDepartemen = false;
                            break;
                        }
                    }
                    foreach ($item2["Parameter"]["Stall"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($item1["namastall"])) {
                            $StallTerdaftar = true;
                            $errorStall = false;
                            break;
                        }
                    }

                    if (count($data["parameter"]["newparameter"]) == 0) {
                        $newparameterTerdaftar = true;
                    } else {
                        if (count($item2["Parameter"]["NewParameter"]) > 0) {
                            $jumlahSPKnewparam = 0;
                            foreach ($data["parameter"]["newparameter"] as $subnewparam) {
                                foreach ($item2["Parameter"]["NewParameter"] as $databaseparam) {
                                    if (strtoupper($subnewparam["Newparam"] == strtoupper($databaseparam["Newparam"]))) {
                                        $jumlahisicomponentspk = 0;
                                        foreach ($subnewparam["Component"] as $componentspk) {
                                            foreach ($databaseparam["Component"] as $componentdatabase) {
                                                if (strtoupper($componentspk) == strtoupper($componentdatabase)) {
                                                    $jumlahisicomponentspk++;
                                                    break;
                                                }
                                            }
                                        }
                                        if ($jumlahisicomponentspk == count($subnewparam["Component"])) {
                                            $jumlahSPKnewparam++;
                                        }
                                    }
                                }
                            }
                            if ($jumlahSPKnewparam == count($data["parameter"]["newparameter"])) {
                                $newparameterTerdaftar = true;
                                $errornewparam = false;
                            }
                        }
                    }

                    if ($ModelMobilterdaftar && $TinggiMobilterdaftar && $TipeMobilTerdaftar && $DepartemenTerdaftar && $StallTerdaftar && $newparameterTerdaftar) {
                        array_push($result, $item2["Kit"]);
                        $i++;
                    }
                    if ($i > 0) {
                        array_push($results, [
                            'kit' => $result,
                            'NoSPK' => $item1->NOSPK,
                        ]);
                        $item1["status"] = "berhasil";
                        $item1["kit"] = $results;
                        $item1->save();
                    } else {
                        $item1["status"] = "Pending";
                        $item1->save();
                    }
                }
                if (!$errorModelMobil && !$errorTinggiMobil && !$errorTipeMobil && !$errorDepartemen && !$errorStall && !$errornewparam) {
                    $item1["errors"] = [];
                    $item1->save();
                } else {
                    if ($errorModelMobil) {
                        array_push($errors, "Parameter Model Mobil SPK ini Baru");
                    }
                    if ($errorTinggiMobil) {
                        array_push($errors, "Parameter Tinggi Mobil SPK ini Baru");
                    }
                    if ($errorTipeMobil) {
                        array_push($errors, "Parameter Tipe Mobil SPK ini Baru");
                    }
                    if ($errorDepartemen) {
                        array_push($errors, "Departemen ini Baru");
                    }
                    if ($errorStall) {
                        array_push($errors, "Stall ini Baru");
                    }
                    if ($errornewparam) {
                        array_push($errors, "Ada parameter baru di SPK ini");
                    }
                    $item1["errors"] = $errors;
                    $item1->save();
                }
            }
        }
        return response()->json([
            "success" => true,
            "status" => 200,
            "spk" => $data,
            "savedconversion" => $saved,
            "master" => $item2,
            "message" => $messages,
            "hasil" => $results,
        ]);
    }

    public function konversisinglespk(Request $request)
    {
        $data = SPK::where('NOSPK', $request->NoSPK)->first();
        $master = Master::all();
        $i = 0;
        $results = [];
        $result = [];
        foreach ($master as $item2) {
            $ModelMobilterdaftar = false;
            $TinggiMobilterdaftar = false;
            $TipeMobilTerdaftar = false;
            $newparameterTerdaftar = false;
            foreach ($item2["Parameter"]["ModelMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["ModelMobil"])) {
                    $ModelMobilterdaftar = true;
                    break;
                }
            }
            foreach ($item2["Parameter"]["TinggiMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["TinggiMobil"])) {
                    $TinggiMobilterdaftar = true;
                    break;
                }
            }
            foreach ($item2["Parameter"]["TipeMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["TipeMobil"])) {
                    $TipeMobilTerdaftar = true;
                    break;
                }
            }
            if (count($data["parameter"]["newparameter"]) == 0) {
                $newparameterTerdaftar = true;
            } else {
                if (count($item2["Parameter"]["NewParameter"]) > 0) {
                    $jumlahSPKnewparam = 0;
                    foreach ($data["parameter"]["newparameter"] as $subnewparam) {
                        foreach ($item2["Parameter"]["NewParameter"] as $databaseparam) {
                            if (strtoupper($subnewparam["Newparam"] == strtoupper($databaseparam["Newparam"]))) {
                                $jumlahisicomponentspk = 0;
                                foreach ($subnewparam["Component"] as $componentspk) {
                                    foreach ($databaseparam["Component"] as $componentdatabase) {
                                        if (strtoupper($componentspk) == strtoupper($componentdatabase)) {
                                            $jumlahisicomponentspk++;
                                            break;
                                        }
                                    }
                                }
                                if ($jumlahisicomponentspk == count($subnewparam["Component"])) {
                                    $jumlahSPKnewparam++;
                                }
                            }
                        }
                    }
                    if ($jumlahSPKnewparam == count($data["parameter"]["newparameter"])) {
                        $newparameterTerdaftar = true;
                    }
                }
            }
            if ($ModelMobilterdaftar && $TinggiMobilterdaftar && $TipeMobilTerdaftar && $newparameterTerdaftar) {
                array_push($result, $item2["Kit"]);
                $i++;
            }
            if ($i > 0) {
                array_push($results, [
                    'kit' => $result,
                    'NoSPK' => $data["NOSPK"],
                ]);
            }
        }
        return response()->json([
            "success" => true,
            "status" => 200,
            "hasil" => $results,
        ]);
    }

    public function admintambahspk(Request $request)
    {
        $nospk = strtoupper($request->Nospk);
        $stall = $request->Stall;
        $namastall = $request->NamaStall;
        $Departemen = $request->Departemen;
        if ($stall == 0 || $stall == "" || $nospk == null || $namastall == "" || $Departemen == "") {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        } else {
            try {
                if ($nospk == "STOCK") {
                    // $saved = SavedConversionResult::where('NOSPK',"STOCK")->get();
                    $newdata = SavedConversionResult::create([
                        "NOSPK" => $nospk,
                        "namastall" => $namastall,
                        "Departemen" => $Departemen,
                        "stall" => $stall,
                        "checked" => false,
                        "status" => "Pending",
                        "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                        "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    return response()->json([
                        "success" => true,
                        "status" => 200,
                    ]);
                } else {
                    $spk = SPK::where('NOSPK', $nospk)->first();
                    $parameter = $spk->parameter;
                    $newdata = SavedConversionResult::create([
                        "NOSPK" => $spk->NOSPK,
                        "stall" => $stall,
                        "namastall" => $namastall,
                        "Departemen" => $Departemen,
                        "checked" => false,
                        "status" => "Pending",
                        "parameter" => $parameter,
                        "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                        "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                    return response()->json([
                        "success" => true,
                        "status" => 200,
                        "spk" => $spk,
                        "namastall" => $namastall,
                        "Departemen" => $Departemen,
                        "newdata" => $parameter
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => true,
                    "status" => 403,
                ]);
            }
        }
    }

    public function ambilmax(Request $request)
    {
        $data = $request->kode;
        $spk = SPK::where('NOSPK', $data)->first();
        try {
            return response()->json([
                "success" => true,
                "status" => 200,
                "hasil" => $spk->panjangstall,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        }
    }

    public function getkode(Request $request)
    {
        $data = $request->maudikode;
        $regex = "/[A-Z]{1,7}+/";
        $hasil = [];
        try {
            preg_match_all($regex,  $data, $hasil);
            return response()->json([
                "success" => true,
                "status" => 200,
                "hasil" => $hasil[0][1],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
                "message" => "kodeSPK belum sesuai",
            ]);
        }
    }
}
