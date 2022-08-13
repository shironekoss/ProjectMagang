<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function tambahmaster(Request $request)
    {
        try {
            // $kode = $request->dataparam['kodemobil'];
            // $regex = "/[A-Z]{1,7}+/";
            // $hasil = [];
            // preg_match_all($regex, $kode, $hasil);

            $param = $request->dataparam;
            // $param['kodemobil']=$hasil[0][1];
            $kit = $request->datakit;

            if($param['kodemobil']==""){
                $param['kodemobil']="All";
            }
            else{
                $param['kodemobil']=strtoupper($param['kodemobil']);
            }

            if(count($param['modelbagasi'])==0){
                $param['modelbagasi'][0]="All";
            }
            if(count($param['modelpintu'])==0){
                $param['modelpintu'][0]="All";
            }
            if(count($param['modelbangku'])==0){
                $param['modelbangku'][0]="All";
            }
            if(count($param['modelbody'])==0){
                $param['modelbody'][0]="All";
            }
            if(count($param['modellampubelakang'])==0){
                $param['modellampubelakang'][0]="All";
            }
            if(count($param['modelpintu'])==0){
                $param['modelpintu'][0]="All";
            }
            if(count($param['modeltangga'])==0){
                $param['modeltangga'][0]="All";
            }

            // $request->dataparam->kodemobil= $hasil[0][1];

            $Newmaster = Master::create([
                "kit" => $kit,
                "parameter" => $param,
            ]);

            return response()->json([
                "status" => true,
                "message" => $param,
                "data" => $Newmaster
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => true,
                "message" => "Kode Mobil Salah",
                "message" => $request->dataparam,
            ]);
        }
    }

    public function generatemasterkit(Request $request)
    {

        try {
            $listmasterkit = Masterkit::all();
            $masterkit = new Masterkit();
            foreach ($listmasterkit as $kit) {
                if ($kit->kode_kit == strtoupper($request->param)) {
                    $masterkit = $kit;
                    break;
                }
            }

            return response()->json([
                "status" => true,
                "data" => $request->param,
                "message" => $masterkit,
                "result" => $masterkit,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => true,
                "data" => $request->param,
                "message" => "tidak ditemukan",
                "result" => $masterkit,
            ]); //throw $th;
        }
    }
}
