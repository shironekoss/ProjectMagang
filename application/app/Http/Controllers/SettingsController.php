<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Departemen;
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
    public function adddepartemen(Request $request)
    {
        if ($request->namadepartemen == null) {
            return response()->json([
                "statusresponse" => 400,
                "data" => $request->namadepartemen,
                "message"=>"Inputan nama departemen kosong"
            ]);
        }
        $departemens = Departemen::all();
        foreach($departemens as $departemen){
            if( strtolower($departemen->Nama_Departemen)== strtolower($request->namadepartemen)){
                return response()->json([
                    "statusresponse" => 400,
                    "data" => $request->namadepartemen,
                    "message"=>"Nama departemen sudah terdaftar"
                ]);
            }
        }
        $newdept = Departemen::create([
            'Nama_Departemen'=> ucwords($request->namadepartemen),
            'Jumlah_account'=> 0,
        ]);
        return response()->json([
            "statusresponse" => 200,
            "message"=>"Berhasil menambahkan departemen ".  ucwords($request->namadepartemen)
        ]);
    }


    public function hapusdepartemen()
    {
        // try {
        //     $saved = SavedConversionResult::where('_id', $request->id)->first();
        //     $stall = $saved->stall;
        //     $nospk = $saved->NOSPK;
        //     $spk = SPK::where('NOSPK', $nospk)->first();
        //     $stallused = $spk->StallUsed;
        //     $stallused[$stall - 1] = false;
        //     $saved->delete();
        //     $spk->StallUsed = $stallused;
        //     $spk->save();
        //     return response()->json([
        //         "success" => true,
        //         "status" => 200,
        //     ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         "success" => true,
        //         "status" => 400,
        //     ]);
        // }
    }



    public function addAccount(Request $request)
    {
        //cara eloquent fillable
        $validated = $request->validate([
            'username' => 'required|min:5|max:20|unique:App\Models\Account,account_username',
            'name' => 'required|min:4|max:20',
            'password' => 'required|confirmed|min:8|max:20',
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
