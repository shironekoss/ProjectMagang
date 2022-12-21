<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Departemen;
use App\Models\SPK;
use App\Models\Stall;
use Illuminate\Http\Request;

class SettingDepartemenController extends Controller
{
    public function showlisttype(Request $request)
    {
        $result = [];
        $finalresult = [];
        $latihan = SPK::pluck('Tipe')->all();
        foreach ($latihan as $minilatihan) {
            if (!in_array($minilatihan, $result, true)) {
                array_push($result, $minilatihan);
            }
        }
        foreach ($result as $val) {
            $isiresult = (object) array(
                'text' => $val,
                'value' => $val
            );
            array_push($finalresult, $isiresult);
        }
        return response()->json([
            "statusresponse" => 200,
            "data" => $finalresult
        ]);
    }

    public function adddepartemen(Request $request)
    {
        try {
            if ($request->namadepartemen == null) {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Inputan nama departemen kosong"
                ]);
            }
            if (count($request->databaseakses) <= 0) {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Database akses kosong tambahkan terlebih dahulu"
                ]);
            }
            $departemens = Departemen::all();
            foreach ($departemens as $departemen) {
                if (strtolower($departemen->Nama_Departemen) == strtolower($request->namadepartemen)) {
                    return response()->json([
                        "statusresponse" => 400,
                        "data" => $request->namadepartemen,
                        "message" => "Nama departemen sudah terdaftar"
                    ]);
                }
            }
            $newdept = Departemen::create([
                'Nama_Departemen' => ucwords($request->namadepartemen),
                'AksesTipeDatabase' => $request->databaseakses
            ]);
            return response()->json([
                "statusresponse" => 200,
                "message" => "Berhasil menambahkan departemen " .  ucwords($request->namadepartemen)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Menambahkan gagal"
            ]);
        }
    }


    public function updatedepartemen(Request $request)
    {
        try {
            if ($request->namadepartemen == null) {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Inputan nama departemen kosong"
                ]);
            }
            if (count($request->databaseakses) <= 0) {
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message" => "Database akses kosong tambahkan terlebih dahulu"
                ]);
            }
            $departemens = Departemen::all()->except($request->id);
            foreach ($departemens as $departemen) {
                if (strtolower($departemen->Nama_Departemen) == strtolower($request->namadepartemen)) {
                    return response()->json([
                        "statusresponse" => 400,
                        "data" => $request->namadepartemen,
                        "message" => "Nama departemen sudah terdaftar"
                    ]);
                }
            }
            $departemenupdate = Departemen::where('_id', $request->id)->first();
            $stall = Stall::where('NamaDepartemen', $departemenupdate->Nama_Departemen)->get();
            $departemenupdate->Nama_Departemen = $request->namadepartemen;
            $departemenupdate->AksesTipeDatabase = $request->databaseakses;
            $departemenupdate->save();


            foreach ($stall as $isistall) {
                $updatestall = Stall::where('_id', $isistall->_id)->first();
                $updatestall->NamaDepartemen=$request->namadepartemen;
                $updatestall->save();
            }
            return response()->json([
                "statusresponse" => 200,
                "message" => "Sukses Update"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Menambahkan gagal"
            ]);
        }
    }

    public function getupdatedept(Request $request)
    {
        $editdepartemen = Departemen::where('_id', $request->id)->first();
        return response()->json([
            "statusresponse" => 200,
            "data" => $editdepartemen
        ]);
    }

    public function hapusdepartemen(Request $request)
    {
        try {
            $hapusdepartemen = Departemen::where('_id', $request->id)->first();
            $account = Account::where('account_privileges.account_dept', $hapusdepartemen->Nama_Departemen)->get();
            if (count($account) > 0) {
                return response()->json([
                    "statusresponse" => 400,
                    "message" => "Hapus Gagal, Terdapat " . count($account) . " akun yang terdaftar pada departemen ini "
                ]);
            } else {
                $stall = Stall::where('NamaDepartemen', $hapusdepartemen->Nama_Departemen)->get();
                foreach ($stall as $isistall) {
                    $hapusstall = Stall::where('_id', $isistall->_id)->delete();
                }
                $hapusdepartemen->delete();
                return response()->json([
                    "statusresponse" => 200,
                    'message' => $hapusdepartemen->Nama_Departemen . " Berhasil dihapus",
                ]);
            }
            return response()->json([
                "statusresponse" => 200,
                "message" => $hapusdepartemen
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Menambahkan gagal"
            ]);
        }
    }

}
