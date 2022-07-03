<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return $user;
    }
}
