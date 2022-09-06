<?php

namespace App\Http\Controllers;

use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\SPK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use Nette\Utils\Strings;

class AdminController extends Controller
{
    public function getdataspk()
    {
        $listspk = SPK::where('SPKactive', true)->get();
        return $listspk;
    }
    public function getdatatable()
    {
        $listdata = SavedConversionResult::all();
        return $listdata;
    }

    public function hapusdatatable(Request $request)
    {
        try {
            $saved = SavedConversionResult::where('_id', $request->id)->first();
            $stall = $saved->stall;
            $nospk = $saved->NOSPK;
            $spk = SPK::where('NOSPK', $nospk)->first();
            $stallused = $spk->StallUsed;
            $stallused[$stall - 1] = false;
            $saved->delete();
            $spk->StallUsed = $stallused;
            $spk->save();
            return response()->json([
                "success" => true,
                "status" => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        }
    }

    public function konversikomponen()
    {
        $saved = SavedConversionResult::all();
        $master = Master::all();
        $messages = [];
        $results = [];
        foreach ($saved as $item1) {
            $message = [];
            $result = [];
            $paramkodemobil = false;
            $kodemobilterdaftar = false;
            $parammobilbagasi = false;
            $parammobilbagasiterdaftar = false;
            $parammodelpintu = false;
            $parammodelpintuterdaftar = false;
            $parammodelbangku = false;
            $parammodelbangkuterdaftar = false;
            $parammodelbody = false;
            $parammodelbodyterdaftar = false;
            $parammodeltangga = false;
            $parammodeltanggaterdaftar = false;
            $parammodellampubelakang = false;
            $parammodellampubelakangterdaftar = false;
            $parammodelnewparameter = false;
            $parammodelnewparameterterdaftar = false;
            foreach ($master as $item2) {
                if (strtoupper($item1["parameter"]["kodemobil"]) == strtoupper($item2["parameter"]["kodemobil"]) || strtoupper($item2["parameter"]["kodemobil"]) == "ALL") {
                    $paramkodemobil = true;
                    if(strtoupper($item1["parameter"]["kodemobil"]) == strtoupper($item2["parameter"]["kodemobil"])){
                        $kodemobilterdaftar=true;
                    }
                }
                foreach ($item2["parameter"]["modelbagasi"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbagasi"]) == strtoupper($item)) {
                        $parammobilbagasi = true;
                        if(strtoupper($item1["parameter"]["modelbagasi"]) == strtoupper($item)){
                            $parammobilbagasiterdaftar=true;
                        }
                        break;
                    }
                }
                foreach ($item2["parameter"]["modelpintu"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelpintu"]) == strtoupper($item)) {
                        $parammodelpintu = true;
                        if(strtoupper($item1["parameter"]["modelpintu"]) == strtoupper($item)){
                            $parammodelpintuterdaftar=true;
                        }
                        break;
                    }
                }
                foreach ($item2["parameter"]["modelbangku"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbangku"]) == strtoupper($item)) {
                        $parammodelbangku = true;
                        if(strtoupper($item1["parameter"]["modelbangku"]) == strtoupper($item)){
                            $parammodelbangkuterdaftar=true;
                        }
                        break;
                    }
                }
                foreach ($item2["parameter"]["modelbody"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modelbody"]) == strtoupper($item)) {
                        $parammodelbody = true;
                        if(strtoupper($item1["parameter"]["modelbody"]) == strtoupper($item)){
                            $parammodelbodyterdaftar=true;
                        }
                        break;
                    }
                }
                foreach ($item2["parameter"]["modeltangga"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modeltangga"]) == strtoupper($item)) {
                        $parammodeltangga = true;
                        if(strtoupper($item1["parameter"]["modeltangga"]) == strtoupper($item)){
                            $parammodeltanggaterdaftar=true;
                        }
                        break;
                    }
                }
                foreach ($item2["parameter"]["modellampubelakang"] as $item) {
                    if (strtoupper($item) == "ALL" || strtoupper($item1["parameter"]["modellampubelakang"]) == strtoupper($item)) {
                        $parammodellampubelakang = true;
                        if(strtoupper($item1["parameter"]["modellampubelakang"]) == strtoupper($item)){
                            $parammodellampubelakangterdaftar=true;
                        }
                        break;
                    }
                }
                if(count($item1["parameter"]["newparameter"])==0){
                    $parammodelnewparameter=true;
                }
                else{
                    foreach($item1["parameter"]["newparameter"] as $newparam1){
                       $judulcomponent=0;
                        foreach($item2["parameter"]["newparameter"] as $newparam2){
                            if( strtoupper($newparam1["newparam"])== strtoupper($newparam2["newparam"])){
                                foreach($newparam1["components"] as $components1){
                                    $isicomponent = 0;
                                    foreach($newparam2["components"] as $components2){
                                        if($components1==$components2){
                                            $isicomponent++;
                                        }
                                    }
                                    if($isicomponent==count($newparam1["components"])){
                                        $judulcomponent++;
                                    }
                                }
                            }
                        }
                    }

                    // if()
                }
                if ($paramkodemobil && $parammobilbagasi && $parammodelpintu && $parammodelbangku &&$parammodelbody && $parammodeltangga && $parammodellampubelakang && $parammodelnewparameter) {
                    array_push($result, $item2["kit"]);
                }
            }
            $newresult = [
                'kit' => $result,
                'NoSPK' => $item1->NOSPK,
            ];
            array_push($results, $newresult);
            array_push($message, "SPK dengan Nomor " . $item1["NOSPK"]);
            if (!$kodemobilterdaftar) {
                array_push($message,  "parameter kode mobil " . $item1["parameter"]["kodemobil"] . " merupakan parameter baru");
            }
            if (!$parammobilbagasiterdaftar) {
                array_push($message,  "parameter model bagasi " . $item1["parameter"]["modelbagasi"] . " merupakan parameter baru");
            }
            if (!$parammodelpintuterdaftar) {
                array_push($message,  "parameter model pintu " . $item1["parameter"]["modelpintu"] . " merupakan parameter baru");
            }
            if (!$parammodelbangkuterdaftar) {
                array_push($message,  "parameter model bangku " . $item1["parameter"]["modelbangku"] . " merupakan parameter baru");
            }
            if (!$parammodelbodyterdaftar) {
                array_push($message,  "parameter model body " . $item1["parameter"]["modelbody"] . " merupakan parameter baru");
            }
            if (!$parammodeltanggaterdaftar) {
                array_push($message,  "parameter model tangga " . $item1["parameter"]["modeltangga"] . " merupakan parameter baru");
            }
            if (!$parammodellampubelakangterdaftar) {
                array_push($message,  "parameter model lampu belakang " . $item1["parameter"]["modellampubelakang"] . " merupakan parameter baru");
            }

            $newmessage = [
                'NoSPK' => $item1->NOSPK,
                'Message' => $message
            ];
            if($kodemobilterdaftar && $parammobilbagasiterdaftar && $parammodelpintuterdaftar && $parammodelbangkuterdaftar && $parammodelbodyterdaftar && $parammodeltanggaterdaftar && $parammodellampubelakangterdaftar){
                $item1["status"]="Done";
                $item1->save();
            }
            else{
                $item1["status"]="Master Not Updated";
                $item1->save();
            }
            array_push($messages, $newmessage);
        }
        return response()->json([
            "success" => true,
            "status" => 200,
            "saved" => $saved,
            "master" => $master,
            "message" => $messages,
            "result" => $results,
            "latihan nembak "=> count($master[8]["parameter"]["newparameter"])
        ]);
    }

    public function admintambahspk(Request $request)
    {
        $nospk = strtoupper($request->nospk);
        $stall = $request->stall;
        $kode = $request->kode;
        if ($stall == 0 || $nospk == null || $kode == null) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        } else {
            try {
                $spk = SPK::where('NOSPK', $nospk)->first();
                $array = $spk->StallUsed;
                if ($spk["StallUsed"][$stall - 1] == false) {
                    $parameter = $spk->parameter;
                    $parameter["stall"] = $stall;
                    $newdata = SavedConversionResult::create([
                        "NOSPK" => $spk->NOSPK,
                        "stall" => $stall,
                        "checked" => false,
                        "kode" => $kode,
                        "status" => "Pending",
                        "parameter" => $parameter,
                        "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                        "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);

                    $array[$stall - 1] = true;
                    $spk->StallUsed = $array;
                    $spk->save();
                    return response()->json([
                        "success" => true,
                        "status" => 200,
                        "spk" => $spk["StallUsed"],
                        "newdata" => $parameter
                    ]);
                } elseif ($spk["StallUsed"][$stall - 1] == true) {
                    return response()->json([
                        "success" => true,
                        "status" => 401,
                        "spk" => "sudah ada woi",
                        "newdata" => "Tidak ada data baru"
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    "success" => true,
                    "status" => 403,
                ]);
            }
        }
    }

    public function ambilmax(Request $request)
    {
        $data = $request->kode;
        $spk = SPK::where('NOSPK', $data)->first();
        try {
            return response()->json([
                "success" => true,
                "status" => 200,
                "hasil" => $spk->panjangstall,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
            ]);
        }
    }
    public function getkode(Request $request)
    {
        $data = $request->maudikode;
        $regex = "/[A-Z]{1,7}+/";
        $hasil = [];
        try {
            preg_match_all($regex,  $data, $hasil);
            return response()->json([
                "success" => true,
                "status" => 200,
                "hasil" => $hasil[0][1],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => true,
                "status" => 400,
                "message" => "kodeSPK belum sesuai",
            ]);
        }
    }
}
