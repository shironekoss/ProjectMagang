<?php

namespace App\Http\Controllers;

use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\SPK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class AdminController extends Controller
{
    public function getdataspk()
    {
        // $listspk = SPK::where('SPKactive',true)->get();
        $listspk = SPK::where('SPKactive', true)->get();
        return $listspk;
    }
    public function getdatatable()
    {
        $listdata = SavedConversionResult::all();
        return $listdata;
    }

    public function admintambahspk(Request $request)
    {
        $nospk = strtoupper($request->nospk);
        $stall = $request->stall;
        $kode = $request->kode;
        if ($stall == 0 || $nospk == null || $kode == null) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        } else {
            try {
                $spk = SPK::where('NOSPK', $nospk)->first();
                $array = $spk->StallUsed;
                if ($spk["StallUsed"][$stall - 1] == false) {
                    $parameter = $spk->parameter;
                    $parameter["stall"] = $stall;
                    $newdata = SavedConversionResult::create([
                        "NOSPK" => $spk->NOSPK,
                        "stall" => $stall,
                        "kode" => $kode,
                        'parameter' => $parameter,
                    ]);

                    $array[$stall - 1] = true;
                    $spk->StallUsed = $array;
                    $spk->save();
                    return response()->json([
                        "success" => true,
                        "status" => 200,
                        "spk" => $spk["StallUsed"],
                        "newdata" => $parameter
                    ]);
                } elseif ($spk["StallUsed"][$stall - 1] == true) {
                    return response()->json([
                        "success" => true,
                        "status" => 401,
                        "spk" => "sudah ada woi",
                        "newdata" => "Tidak ada data baru"
                    ]);
                }
                //
                //    else {
                // }
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => true,
                    "status" => 403,
                ]);
            }



            // $newdata = SavedConversionResult::create([
            //
            // ]);

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
