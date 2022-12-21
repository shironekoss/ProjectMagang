<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Stall;
use Illuminate\Http\Request;

class SettingStallController extends Controller
{
    public function getlistdepartemensetting(Request $request)
    {
        $listdept = Departemen::all();
        $result = [];
        foreach ($listdept as $dept) {
            $isiresult = (object) array(
                'text' => $dept->Nama_Departemen,
                'value' => $dept->Nama_Departemen
            );
            array_push($result, $isiresult);
        }
        return response()->json([
            "statusresponse" => 200,
            "data" => $result
        ]);
    }

    public function getliststall()
    {
        $liststall = Stall::all();
        return response()->json([
            "statusresponse" => 200,
            "data" => $liststall
        ]);
    }

    public function addstall(Request $request)
    {
        try {
            if ($request->NamaDepartemen == "" || $request->NamaStall == "" || $request->JumlahStall == "") {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Inputan ada yang kosong"
                ]);
            }
            $stalls = Stall::all();
            foreach ($stalls as $key) {
                if (ucwords($key->NamaStall) == ucwords($request->NamaStall) && ucwords($key->NamaDepartemen) == ucwords($request->NamaDepartemen)) {
                    return response()->json([
                        "statusresponse" => 400,
                        "data" => $request->namadepartemen,
                        "message" => "Nama Stall & Departemennya Sudah Terdaftar"
                    ]);
                    break;
                }
            }
            $newstall = Stall::create([
                'NamaDepartemen' => ucwords($request->NamaDepartemen),
                'NamaStall' => ucwords($request->NamaStall),
                'JumlahStall' => ucwords($request->JumlahStall),
            ]);
            return response()->json([
                "statusresponse" => 200,
                "message" => "Berhasil menambahkan Stall " .  ucwords($request->NamaStall),
                "test" => $stalls
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Menambahkan gagal"
            ]);
        }
    }

    public function updatestall(Request $request)
    {
        try {
            if ($request->NamaDepartemen == "" || $request->NamaStall == "" || $request->JumlahStall == "") {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Inputan ada yang kosong"
                ]);
            }
            $stallygdiupdate = Stall::where('_id', $request->id)->first();
            $stalls = Stall::all()->except($request->id);
            foreach ($stalls as $stall) {
                if (ucwords($stall->NamaDepartemen) == ucwords($request->NamaDepartemen) && ucwords($stall->NamaStall) == ucwords($request->NamaStall)) {
                    return response()->json([
                        "statusresponse" => 400,
                        "message" => "Stall dan Nama Departemen Sudah Terdaftar",
                    ]);
                }
            }
            $stallygdiupdate->NamaStall = $request->NamaStall;
            $stallygdiupdate->NamaDepartemen = $request->NamaDepartemen;
            $stallygdiupdate->JumlahStall = $request->JumlahStall;
            $stallygdiupdate->save();

            return response()->json([
                "statusresponse" => 200,
                "message" => "Stall " . $request->NamaStall .   " Berhasil Diupdate",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Update gagal"
            ]);
        }
    }
}
