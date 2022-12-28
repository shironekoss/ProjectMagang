<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Master;
use App\Models\SPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckFullController extends Controller
{
    public function checkfull(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $spklist = SPK::all();
            return $spklist;
        } else {
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $spklist = SPK::whereIn('Tipe', $Departemen->AksesTipeDatabase)->get();
            return $spklist;
        }
    }

    public function konversicheckfull(Request $request)
    {
        $allSPK = $request->NoSPK;
        $finalresult = [];
        foreach ($allSPK as $SPKSingle) {
            $data = SPK::where('NOSPK', $SPKSingle)->first();
            $master = Master::all();
            $i = 0;
            $results = [];
            $result = [];
            $errors = [];
            $parameteroModelMobilTerdaftar = false;
            $parameterTinggiTerdaftar = false;
            $parameterTipeMobilTerdaftar = false;
            $parameterNewparamTerdaftar = false;
            foreach ($master as $item2) {
                $ModelMobilterdaftar = false;
                $TinggiMobilterdaftar = false;
                $TipeMobilTerdaftar = false;
                $newparameterTerdaftar = false;
                foreach ($item2["Parameter"]["ModelMobil"] as $subitem2) {
                    if (strtoupper($subitem2) == strtoupper($data["parameter"]["ModelMobil"])) {
                        $ModelMobilterdaftar = true;
                        $parameteroModelMobilTerdaftar = true;
                        break;
                    }
                }
                foreach ($item2["Parameter"]["TinggiMobil"] as $subitem2) {
                    if (strtoupper($subitem2) == strtoupper($data["parameter"]["TinggiMobil"])) {
                        $TinggiMobilterdaftar = true;
                        $parameterTinggiTerdaftar = true;
                        break;
                    }
                }
                foreach ($item2["Parameter"]["TipeMobil"] as $subitem2) {
                    if (strtoupper($subitem2) == strtoupper($data["parameter"]["TipeMobil"])) {
                        $TipeMobilTerdaftar = true;
                        $parameterTipeMobilTerdaftar = true;
                        break;
                    }
                }
                if (count($item2["Parameter"]["NewParameter"]) == 0) {
                    $newparameterTerdaftar = true;
                } else {
                    if (count($item2["Parameter"]["NewParameter"]) > 0) {
                        $jumlahSPKnewparam = 0;
                        foreach ($data["parameter"]["newparameter"] as $subnewparam) {
                            foreach ($item2["Parameter"]["NewParameter"] as $databaseparam) {
                                if (strtoupper($subnewparam["Newparam"] == strtoupper($databaseparam["Newparam"]))) {
                                    $isisama = false;
                                    foreach ($subnewparam["Component"] as $componentspk) {
                                        foreach ($databaseparam["Component"] as $componentdatabase) {
                                            if (strtoupper($componentspk) == strtoupper($componentdatabase)) {
                                                $isisama = true;
                                                break;
                                            }
                                        }
                                        if ($isisama) {
                                            $jumlahSPKnewparam++;
                                            break;
                                        }
                                    }
                                }
                            }
                        }
                        if ($jumlahSPKnewparam == count($item2["Parameter"]["NewParameter"])) {
                            $newparameterTerdaftar = true;
                            $parameterNewparamTerdaftar = true;
                        }
                    }
                }
                if ($ModelMobilterdaftar && $TinggiMobilterdaftar && $TipeMobilTerdaftar && $newparameterTerdaftar) {
                    // $tempkit =[];
                    $kitfinal = $item2["Kit"];
                    $j = 0;
                    foreach ($item2["Kit"] as $kit) {
                        $tempIsikit = [];
                        foreach ($kit["IsiKit"] as $isikit) {
                            $available = DB::connection('sqlsrv')
                                ->table('ITEMKITMAINTENANCE')
                                ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
                                ->where('iv00102.RCRDTYPE', '=', "2")
                                ->where('iv00102.LOCNCODE', '=', $kit["siteID"])
                                ->where('ITEMKITMAINTENANCE.Component Item Description', $isikit["nama_komponen"])
                                ->pluck("QTYONHND")
                                ->first();
                            $isikit["Qty_Available"] = $available;
                            array_push($tempIsikit, $isikit);
                        }
                        $kitfinal[$j]["IsiKit"] = $tempIsikit;
                        $j++;
                    }
                    array_push($result, $kitfinal);
                    $i++;
                }
                if ($i > 0) {
                    array_push($results, [
                        'kit' => $result[0],
                        'NoSPK' => $data["NOSPK"],
                    ]);
                }
            }
            $errorcheck = 0;
            if (!$parameteroModelMobilTerdaftar) {
                array_push($errors, " Model Mobil Tidak Terdaftar");
                $errorcheck++;
            }
            if (!$parameterTinggiTerdaftar) {
                array_push($errors, " Tinggi Mobil Tidak Terdaftar");
                $errorcheck++;
            }
            if (!$parameterTipeMobilTerdaftar) {
                array_push($errors, " Tipe Mobil Tidak Terdaftar");
                $errorcheck++;
            }
            if (!$parameterNewparamTerdaftar) {
                array_push($errors, " Ada parameter baru yang belum terdaftar");
                $errorcheck++;
            }
            if ($errorcheck > 0) {
                $results[0]["errors"] = $errors;
                $results[0]["kit"] = [
                    [
                        "NamaKit" => "",
                        "Kodekit" => "",
                        "IsiKit" => [[
                            "kode_komponen" => "",
                            "nama_komponen" => "",
                            "qty" => "",
                            "Satuan" => "",
                            "Qty_Available" => "",
                        ]],
                        "siteID" => ""
                    ]
                ];
                $results[0]["NoSPK"] = $data["NOSPK"];
            }
            array_push($finalresult, $results[0]);
        }
        return response()->json([
            "success" => true,
            "status" => 200,
            "hasil" => $finalresult,
        ]);
    }
}
