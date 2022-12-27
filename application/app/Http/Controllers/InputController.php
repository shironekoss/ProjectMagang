<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\SPK;
use Illuminate\Http\Request;

class InputController extends Controller
{
    public function managespknum(Request $request)
    {
        if ($request->Role == "Super Admin Role") {
            $spklist = SPK::all();
            return $spklist;
        } else {
            $Departemen = Departemen::where('Nama_Departemen', $request->Departemen)->first();
            $spklist = SPK::whereIn('Tipe', $Departemen->AksesTipeDatabase)->get();
            return $spklist;
        }
    }

    public function savedspknum(Request $request)
    {
        $allSPK = $request->NoSPK;
        $departemen = $request->Departemen;
        $unselected = $request->unselectedSPK;
        if (count($allSPK) > 0) {
            foreach ($allSPK as $spk) {
                $changed = SPK::where('NOSPK', $spk)->first();
                if ($changed->check == null) {
                    $changed->check = [
                        [
                            $departemen => true
                        ]
                    ];
                } else {
                    $terdaftar = false;
                    foreach ($changed->check as $subcheck) {
                        if (isset($subcheck[$departemen])) {
                            $terdaftar = true;
                        }
                    }
                    if (!$terdaftar) {
                        $temp = $changed->check;
                        array_push($temp, [$departemen => true]);
                        $changed->check = $temp;
                    }
                    else{
                        $temp = $changed->check;
                        $int=0;
                        foreach($changed->check as $subcheck){
                            if(array_key_exists($departemen,$subcheck)){
                                $temp[$int][$departemen]=true;
                            }
                            $int++;
                        }
                    }
                }
                $changed->save();
            }
        }
        if (count($unselected) > 0) {
            foreach ($unselected as $unmarkspk) {
                $changed = SPK::where('NOSPK', $unmarkspk)->first();
                $temp = $changed->check;
                $int=0;
                foreach($temp as $subtemp){
                    if(array_key_exists($departemen,$subtemp)){
                        $temp[$int][$departemen]=false;
                        break;
                    }
                    $int++;
                }
                $changed->check = $temp;
                $changed->save();
            }
        }

        return response()->json([
            "success" => true,
        ]);
    }
}
