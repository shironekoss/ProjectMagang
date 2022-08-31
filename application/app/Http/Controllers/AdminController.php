<?php

namespace App\Http\Controllers;

use App\Models\SPK;
use Illuminate\Http\Request;
use Nette\Utils\Strings;

class AdminController extends Controller
{
    public function getdataspk()
    {
        // $listspk = SPK::where('SPKactive',true)->get();
        $listspk=SPK::where('SPKactive',true)->get();
        return $listspk;
    }
    public function getkode(Request $request)
    {
        $teks1 = "Bsas121A122";
        $regex = "/[A-Z]{1,7}+/";
        $hasil = [];
        try {
            preg_match_all($regex, $teks1, $hasil);
            dd($hasil[0][1]);
        } catch (\Throwable $th) {
            dd("kode salah");
        }
    }
}
