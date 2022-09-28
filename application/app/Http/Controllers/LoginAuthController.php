<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class LoginAuthController extends Controller
{
    public function loginfunction(Request $request)
    {
        $listuser = Account::all();
        foreach ($listuser as $user) {
            if($user->account_username == $request->username && $user->account_password == $request->password){
                $token = $user->createToken('ApiToken')->plainTextToken;
                return response()->json([[
                    'user'=>$user,
                    'token'=>$token
                ]]);
            }
        }
        return response()->json([
            null
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'success'    => true
        ], 200);
    }
}
