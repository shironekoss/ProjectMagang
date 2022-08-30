<?php

namespace App\Http\Controllers;

use App\Models\SPK;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getdataspk()
    {
        // $listspk = SPK::where('SPKactive',true)->get();
        $listspk=SPK::where('SPKactive',true)->get();
        return $listspk;
    }
}
