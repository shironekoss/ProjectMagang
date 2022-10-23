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
        $listspk = SPK::where('SPKactive', true)->get();
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
            if ($item1["NOSPK"] == "STOCK") {
                foreach ($master as $item2) {
                    foreach ($item2["Parameter"]["Stock"] as $subitem2) {
                        if (strtoupper($subitem2) == strtoupper($item1["stall"])) {
                            array_push($result, $item2["Kit"]);
                            break;
                        }
                    }
                }
            } else {
                foreach ($master as $item2) {
                    $data = SPK::where('NOSPK', $item1["NOSPK"])->first();
                    $ModelMobilterdaftar = false;
                    $TinggiMobilterdaftar = false;
                    $TipeMobilTerdaftar = false;
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
                    if ($ModelMobilterdaftar && $TinggiMobilterdaftar && $TipeMobilTerdaftar) {
                        array_push($result, $item2["Kit"]);
                    }
                }
            }
            if (count($result) > 0) {
                array_push($results, [
                    'kit' => $result,
                    'NoSPK' => $item1->NOSPK,
                ]);
                $item1["status"] = "berhasil";
                $item1->save();
            }
        }

        return response()->json([
            "success" => true,
            "status" => 200,
            // "saved" => $saved,
            // "master" => $master,
            // "message" => $messages,
            "hasil" => $results,
        ]);

        // return response()->json([
        //     "success" => true,
        //     "status" => 200,
        //     "saved" => $saved,
        //     "master" => $master,
        //     "message" => $messages,
        //     "result" => $results,
        // ]);

        //     $message = [];
        //     $result = [];
        //     $messageforneparam = [];
        //     $paramkodemobil = false;
        //
        //     $parammodelpintuterdaftar = false;
        //     $parammodelbangku = false;
        //     $parammodelbangkuterdaftar = false;
        //     $parammodelbody = false;
        //     $parammodelbodyterdaftar = false;
        //     $parammodeltangga = false;
        //     $parammodeltanggaterdaftar = false;
        //     $parammodellampubelakang = false;
        //     $parammodellampubelakangterdaftar = false;
        //     $parammodelstall = false;
        //     $parammodelstallterdaftar = false;
        //     $parammodelnewparameter = false;
        //     foreach ($master as $item2) {
        //         if (strtoupper($item1["parameter"]["kodemobil"]) == strtoupper($item2["parameter"]["kodemobil"]) || strtoupper($item2["parameter"]["kodemobil"]) == "ALL") {
        //             $paramkodemobil = true;
        //             if (strtoupper($item1["parameter"]["kodemobil"]) == strtoupper($item2["parameter"]["kodemobil"])) {
        //                 $kodemobilterdaftar = true;
        //             }
        //         }
        //         if (strtoupper($item1["parameter"]["stall"]) == strtoupper($item2["parameter"]["stall"]) || strtoupper($item2["parameter"]["stall"]) == "ALL") {
        //             $parammodelstall = true;
        //             if (strtoupper($item1["parameter"]["stall"]) == strtoupper($item2["parameter"]["stall"])) {
        //                 $parammodelstallterdaftar = true;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modelbagasi"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbagasi"]) == strtoupper($item)) {
        //                 $parammobilbagasi = true;
        //                 if (strtoupper($item1["parameter"]["modelbagasi"]) == strtoupper($item)) {
        //                     $parammobilbagasiterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modelpintu"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelpintu"]) == strtoupper($item)) {
        //                 $parammodelpintu = true;
        //                 if (strtoupper($item1["parameter"]["modelpintu"]) == strtoupper($item)) {
        //                     $parammodelpintuterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modelbangku"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbangku"]) == strtoupper($item)) {
        //                 $parammodelbangku = true;
        //                 if (strtoupper($item1["parameter"]["modelbangku"]) == strtoupper($item)) {
        //                     $parammodelbangkuterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modelbody"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbody"]) == strtoupper($item)) {
        //                 $parammodelbody = true;
        //                 if (strtoupper($item1["parameter"]["modelbody"]) == strtoupper($item)) {
        //                     $parammodelbodyterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modeltangga"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modeltangga"]) == strtoupper($item)) {
        //                 $parammodeltangga = true;
        //                 if (strtoupper($item1["parameter"]["modeltangga"]) == strtoupper($item)) {
        //                     $parammodeltanggaterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //         foreach ($item2["parameter"]["modellampubelakang"] as $item) {
        //             if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modellampubelakang"]) == strtoupper($item)) {
        //                 $parammodellampubelakang = true;
        //                 if (strtoupper($item1["parameter"]["modellampubelakang"]) == strtoupper($item)) {
        //                     $parammodellampubelakangterdaftar = true;
        //                 }
        //                 break;
        //             }
        //         }
        //     }
        //     if (count($item1["parameter"]["newparameter"]) == 0) {
        //         $parammodelnewparameter = true;
        //     } else {
        //         if (count($master) == 0) {
        //             foreach ($item1["parameter"]["newparameter"] as $parameterbaru) {
        //                 array_push($messageforneparam, "parameter tambahan " . $parameterbaru["newparam"] . " tidak ada");
        //             }
        //         } else {
        //             $masterempty = 0;
        //             foreach ($master as $item2) {
        //                 if (count($item2["parameter"]["newparameter"]) != 0) {
        //                     $masterempty += 1;
        //                 }
        //             }
        //             if ($masterempty != 0) {
        //                 array_push($messageforneparam, "parameter tambahan " . " tidak ada");
        //             } else {
        //                 foreach ($master as $item2) {
        //                     $judulcomponent = 0;
        //                     foreach ($item1["parameter"]["newparameter"] as $newparam1) {
        //                         foreach ($item2["parameter"]["newparameter"] as $newparam2) {
        //                             if (strtoupper($newparam1["newparam"]) == strtoupper($newparam2["newparam"])) {
        //                                 $isicomponent = 0;
        //                                 foreach ($newparam1["components"] as $components1) {
        //                                     foreach ($newparam2["components"] as $components2) {
        //                                         if ($components1 == $components2) {
        //                                             $isicomponent++;
        //                                         }
        //                                     }
        //                                 }
        //                                 if ($isicomponent == count($newparam1["components"])) {
        //                                     $judulcomponent++;
        //                                 } else {
        //                                     array_push($messageforneparam, "parameter tambahan " . $item1["parameter"]["newparameter"]["newparam"] . " tolong dicek kembali");
        //                                 }
        //                             }
        //                         }
        //                     }
        //                     if ($judulcomponent == count($item1["parameter"]["newparameter"])) {
        //                         $parammodelnewparameter = true;
        //                     } else if (count($messageforneparam) == 0) {
        //                         array_push($messageforneparam, "parameter tambahan " . $item1["parameter"]["newparameter"][0]["newparam"] . " tidak ada");
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     if ($paramkodemobil && $parammobilbagasi && $parammodelpintu && $parammodelbangku && $parammodelbody && $parammodeltangga && $parammodellampubelakang && $parammodelnewparameter && $parammodelstall) {
        //         array_push($result, $item2["kit"]);
        //     }
        //     $newresult = [
        //         'kit' => $result,
        //         'NoSPK' => $item1->NOSPK,
        //     ];
        //     array_push($results, $newresult);
        //     if (!$kodemobilterdaftar) {
        //         array_push($message,  "parameter kode mobil " . $item1["parameter"]["kodemobil"] . " merupakan parameter baru");
        //     }
        //     if (!$parammobilbagasiterdaftar) {
        //         array_push($message,  "parameter model bagasi " . $item1["parameter"]["modelbagasi"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodelpintuterdaftar) {
        //         array_push($message,  "parameter model pintu " . $item1["parameter"]["modelpintu"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodelbangkuterdaftar) {
        //         array_push($message,  "parameter model bangku " . $item1["parameter"]["modelbangku"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodelbodyterdaftar) {
        //         array_push($message,  "parameter model body " . $item1["parameter"]["modelbody"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodeltanggaterdaftar) {
        //         array_push($message,  "parameter model tangga " . $item1["parameter"]["modeltangga"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodellampubelakangterdaftar) {
        //         array_push($message,  "parameter model lampu belakang " . $item1["parameter"]["modellampubelakang"] . " merupakan parameter baru");
        //     }
        //     if (!$parammodelstallterdaftar) {
        //         array_push($message,  "parameter stall " . $item1["parameter"]["modellampubelakang"] . " merupakan parameter baru");
        //     }

        //     $newmessage = [
        //         'NoSPK' => $item1->NOSPK,
        //         'Message' => $message,
        //         'newMessage' => $messageforneparam
        //     ];
        //     if ($kodemobilterdaftar && $parammobilbagasiterdaftar && $parammodelpintuterdaftar && $parammodelbangkuterdaftar && $parammodelbodyterdaftar && $parammodeltanggaterdaftar && $parammodellampubelakangterdaftar && $parammodelstallterdaftar && $parammodelnewparameter) {
        //         $item1["status"] = "Done";
        //         $item1->save();
        //     } else {
        //         $item1["status"] = "Master Not Updated";
        //         $item1->save();
        //     }
        //     array_push($messages, $newmessage);
        // }

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
