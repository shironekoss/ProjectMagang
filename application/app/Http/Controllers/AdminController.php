<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\SPK;
use App\Models\Stall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Nette\Utils\Strings;

class AdminController extends Controller
{
    public function listspkshow(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $spklist = SPK::all()->pluck('NOSPK');
            return $spklist;
        } else {
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $spklist = SPK::whereIn('Tipe', $Departemen->AksesTipeDatabase)->pluck('NOSPK');
            return $spklist;
        }
    }

    public function checkfull(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $spklist = SPK::all();
            return $spklist;
        } else {
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $spklist = SPK::whereIn('Tipe', $Departemen->AksesTipeDatabase);
            return $spklist;
        }
    }
    public function getdatatable()
    {
        $listdata = SavedConversionResult::where('status', '!=', 'berhasil')->get();
        return $listdata;
    }
    public function getdatatables(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $listdata = SavedConversionResult::where('status', '!=', 'berhasil')->get();
            return $listdata;
        }else{
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $listdata = SavedConversionResult::where('status', '!=', 'berhasil')
                        ->where('Departemen',$Departemen->Nama_Departemen)
                        ->get();
            return $listdata;
        }
    }

    public function getdatatablehistory(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $listdata = SavedConversionResult::where('status', 'berhasil')->get();
            return $listdata;
        }else{
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $listdata = SavedConversionResult::where('status', 'berhasil')
                        ->where('Departemen',$Departemen->Nama_Departemen)
                        ->get();
            return $listdata;
        }
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

    public function konversikomponen(Request $request)
    {
        $data = SPK::where('NOSPK', "A01JM22")->first();
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
                $tempkit = [];
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
                        $isikit["Qty_Available"]=$available;
                        array_push($tempIsikit,$isikit);
                    }
                    array_push($tempkit,$tempIsikit);
                }
                // dd($tempkit);
                array_push($result, $tempkit);
                $i++;
            }
            if ($i > 0) {
                array_push($results, [
                    'kit' => $result,
                    'NoSPK' => $data["NOSPK"],
                ]);
            }
        }
        if (!$parameteroModelMobilTerdaftar) {
            array_push($errors, " Model Mobil Tidak Terdaftar");
        }
        if (!$parameterTinggiTerdaftar) {
            array_push($errors, " Tinggi Mobil Tidak Terdaftar");
        }
        if (!$parameterTipeMobilTerdaftar) {
            array_push($errors, " Tipe Mobil Tidak Terdaftar");
        }
        if (!$parameterNewparamTerdaftar) {
            array_push($errors, " Ada parameter baru yang belum terdaftar");
        }

        return response()->json([
            "success" => true,
            "status" => 200,
            "hasil" => $results,
            "errors" => $errors
        ]);
    }


    public function konversicheckfull(Request $request)
    {
        $data = SPK::where('NOSPK', $request->NoSPK)->first();
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
                $tempkit =[];
                $kitfinal = $item2["Kit"][0];
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
                        $isikit["Qty_Available"]=$available;
                        array_push($tempIsikit,$isikit);
                    }
                    array_push($tempkit,$tempIsikit);
                }
                $kitfinal["IsiKit"]=$tempkit[0];
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
        if (!$parameteroModelMobilTerdaftar) {
            array_push($errors, " Model Mobil Tidak Terdaftar");
        }
        if (!$parameterTinggiTerdaftar) {
            array_push($errors, " Tinggi Mobil Tidak Terdaftar");
        }
        if (!$parameterTipeMobilTerdaftar) {
            array_push($errors, " Tipe Mobil Tidak Terdaftar");
        }
        if (!$parameterNewparamTerdaftar) {
            array_push($errors, " Ada parameter baru yang belum terdaftar");
        }

        return response()->json([
            "success" => true,
            "status" => 200,
            "hasil" => $results,
            "errors" => $errors
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
                    $allsaved = SavedConversionResult::where('NOSPK', '!=', "STOCK")->get(['NOSPK', 'Departemen', 'namastall', 'stall']);
                    $kembar = false;
                    foreach ($allsaved as $saved) {
                        if (strtoupper($nospk) == strtoupper($saved["NOSPK"])  && strtoupper($Departemen) == strtoupper($saved["Departemen"]) &&  strtoupper($stall) == strtoupper($saved["stall"]) && strtoupper($namastall) == strtoupper($saved["namastall"])) {
                            $kembar = true;
                            break;
                        }
                    }
                    if ($kembar) {
                        return response()->json([
                            "success" => true,
                            "status" => 401,
                        ]);
                    } else {
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
                            "newdata" => $parameter,
                            "allsaved" => $allsaved
                        ]);
                    }
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
