<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
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
    public function store(Request $request)
    {
        //cara eloquent fillable
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user =User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
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
}
