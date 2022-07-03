<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function ambiluser()
    {
        $users = User::all();
       return response()->json($users);
    }
    public function show($id)
    {
        $users = User::find($id);
        // $users = DB::table('users')->select( 'id' , 'name')->where('id',$id) ->first();
       return response()->json($users);
    }
    public function store(Request $request)
    {
        //cara eloquent fillable
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
