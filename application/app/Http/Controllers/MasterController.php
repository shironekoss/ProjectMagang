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
            $kode = $request->dataparam['kodemobil'];
            $regex = "/[A-Z]{1,7}+/";
            $hasil = [];
            preg_match_all($regex, $kode, $hasil);

            $param = $request->dataparam;
            $param['kodemobil']=$hasil[0][1];
            $kit = $request->datakit;

            // $request->dataparam->kodemobil= $hasil[0][1];

            $Newmaster = Master::create([
                "kit" => $kit,
                "parameter" => $param,
            ]);

            return response()->json([
                "status" => true,
                "message" => $param,
                "data" => $Newmaster
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => true,
                "message" => "Kode Mobil Salah",
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
