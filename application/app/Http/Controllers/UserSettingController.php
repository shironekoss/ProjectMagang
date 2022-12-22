<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function ambilaccounts()
    {
        $users = Account::all();
        return $users;
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
