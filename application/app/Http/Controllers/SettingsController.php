<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Departemen;
use App\Models\SPK;
use App\Models\Stall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function ambilaccounts()
    {
        $users = Account::all();
        return $users;
    }
    public function show($id)
    {
        $users = Account::find($id);
        return $users;
    }

    public function showdepartemen()
    {
        $departemens = Departemen::all();
        return response()->json([
            "statusresponse" => 200,
            "data" => $departemens
        ]);
    }

    public function showlisttype(Request $request)
    {
        $result = [];
        $finalresult=[];
        $latihan = SPK::pluck('Tipe')->all();
        foreach ($latihan as $minilatihan) {
            if (!in_array($minilatihan, $result, true)) {
                array_push($result, $minilatihan);
            }
        }

        foreach ($result as $val) {
            $isiresult = (object) array(
                'text' => $val,
                'value' => $val);
            array_push($finalresult, $isiresult);
        }
        return response()->json([
            "statusresponse" => 200,
            "data" => $finalresult
        ]);
    }

    public function getlistdepartemen(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $listdept = Departemen::pluck('Nama_Departemen')->all();
            $result = [];
            foreach ($listdept as $dept) {
                $isiresult = (object) array(
                    'text' => $dept,
                    'value' => $dept
                );
                array_push($result, $isiresult);
            }
            return response()->json([
                "statusresponse" => 200,
                "data" => $result
            ]);
        } else {
            $listdept = Departemen::where('Nama_Departemen', $request->Departemen)->pluck('Nama_Departemen')->all();
            $result = [];
            foreach ($listdept as $dept) {
                $isiresult = (object) array(
                    'text' => $dept,
                    'value' => $dept
                );
                array_push($result, $isiresult);
            }
            return response()->json([
                "statusresponse" => 200,
                "data" => $result
            ]);
        }
    }

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


    public function getlistallparameter(Request $request)
    {
        $liststall = Stall::all();
        $paramstall = $request->Parameterdeps;
        $result = [];
        foreach ($liststall as $stall) {
            foreach ($paramstall as $param) {
                if (ucwords($stall->NamaDepartemen) == ucwords($param)) {
                    array_push($result, $stall->NamaStall);
                }
            }
        }
        return response()->json([
            "result" => $result,
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
            if(count($request->databaseakses)<=0){
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
                'AksesTipeDatabase'=> $request->databaseakses
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
                // if (ucwords($stall->NamaDepartemen) == ucwords($stallygdiupdate->NamaDepartemen) && ucwords($stall->NamaStall) == ucwords($stallygdiupdate->NamaStall)) {
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

    public function hapusstall(Request $request)
    {
        try {
            $hapusstall = Stall::where('_id', $request->id)->first();
            $hapusstall->delete();
            return response()->json([
                "statusresponse" => 200,
                'message' => $hapusstall->NamaStall . " Berhasil dihapus",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur Menambahkan gagal"
            ]);
        }
    }

    public function saveuser(Request $request)
    {
        $validated = $request->validate([
            'account_username' => 'required|min:5|max:20',
            'account_name' => 'required|min:5|max:20',
            'account_password' => 'required|min:5|max:20',
        ]);


        try {
            return response()->json([
                "statusresponse" => 200,
                "message" => $request->account_name
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                "message" => "Fitur update user gagal"
            ]);
        }
    }

    public function addAccount(Request $request)
    {
        //cara eloquent fillable
        $validated = $request->validate([
            'username' => 'required|min:5|max:20|unique:App\Models\Account,account_username',
            'name' => 'required|min:4|max:20',
            'password' => 'required|confirmed|min:4|max:20',
            'role' => 'required',
            'departemen' => 'required',
        ]);

        $user = Account::create([
            "account_username" => $request->username,
            "account_name" => $request->name,
            "password" => $request->password,
            'account_privileges' => [
                'title' => $request->role,
                'account_dept' => $request->departemen,
            ],
            "account_active" => false,
        ]);
        //cara 2
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        return response()->json([
            "status" => true,
            "message" => 'Data user berhasil disimpan',
            "data" => $user
        ]);
    }
    public function removeaccount($id)
    {
        $user = Account::find($id);
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil dihapus',
        ]);
    }
}
