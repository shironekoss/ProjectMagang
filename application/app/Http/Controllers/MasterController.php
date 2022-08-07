<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function tambahmaster(Request $request)
    {

        $Newmaster =Master::create([
            "kit"=>$request->datakit,
            "parameter"=>$request->dataparam,
        ]);

        return response()->json([
            "status" =>true,
            "message" =>$request,
            "data"=>$Newmaster
        ]);
    }
}
