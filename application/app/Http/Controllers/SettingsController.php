<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function ambiluser()
    {
        $users = DB::table('users')->get();
       return response()->json($users);
    }
}
