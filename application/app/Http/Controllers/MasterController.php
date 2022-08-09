<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
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

    public function generatemasterkit(Request $request)
    {
        $listmasterkit =Masterkit::all();
        $masterkit= new Masterkit();
        foreach($listmasterkit as $kit){
            if($kit->kode_kit == strtoupper($request->param)){
                $masterkit=$kit;
                break;
            }
        }

        return response()->json([
            "status" =>true,
            "data"=>$request->param,
            "message" =>$listmasterkit[0]->kode_kit,
            "result"=>$masterkit,   
        ]);
    }
}
