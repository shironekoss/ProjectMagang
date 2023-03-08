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

    public function getlistdepartemennorole(Request $request)
    {
        $listdept = Departemen::pluck('Nama_Departemen')->all();
        return response()->json([
            "statusresponse" => 200,
            "data" => $listdept
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
            $findaccount = Account::where('_id', $request->_id)->first();
            $findaccount->account_username = $request->account_username;
            $findaccount->account_name = $request->account_name;
            $findaccount->account_password = $request->account_password;
            $findaccount->account_privileges = $request->account_privileges;
            if ($findaccount->save()) {
                return response()->json([
                    "statusresponse" => 200,
                    "message" => $request->account_name,
                    "user" => $findaccount
                ]);
            }
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
            "account_active" => true,
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
}
