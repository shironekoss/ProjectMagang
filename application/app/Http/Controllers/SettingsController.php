<?php

namespace App\Http\Controllers;

use App\Models\Account;
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

        $user =Account::create([
            "account_username"=>$request->username,
            "account_name"=>$request->name,
            "password"=>$request->password,
            'account_privileges'=>[
                'title' => $request->role,
                'account_dept' => $request->departemen,
            ],
            "account_active"=>false,
        ]);
        //cara 2
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();
        return response()->json([
            "status" =>true,
            "message" =>'Data user berhasil disimpan',
            "data"=>$user
        ]);
    }
    public function removeaccount($id)
    {
        $user = Account::find($id);
        $user->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Data user berhasil dihapus',
        ]);
    }
}

