<?php

namespace App\Http\Controllers;

use App\Models\Masterkit;
use App\Models\SPK;
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
        }
        else{
            $spk = SPK::where('NOSPK',$nospk)->first();
            try {
                return response()->json([
                    "success" => true,
                    "status" => 200,
                    "spk" => $nospk,
                    "stall" => $stall,
                    "kode" => $kode,
                    "spk"=>$spk
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => true,
                    "status" => 400,
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
                "hasil" => $spk->Stall,
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
