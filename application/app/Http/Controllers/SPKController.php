<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Departemen;
use App\Models\Komponen;
use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\TempMasterkit;
use App\Models\SPK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Json;
use Symfony\Polyfill\Ctype\Ctype;

class SPKController extends Controller
{
    public function filternospk()
    {
        $teks1 = "B09EKS29";
        $regex = "/[A-Z]{1,7}+/";
        $hasil = [];
        try {
            preg_match_all($regex, $teks1, $hasil);
            dd($hasil[0][1]);
        } catch (\Throwable $th) {
            dd("kode salah");
        }
        # kembalikan data dalam bentuk json

        // $hasil=Komponen::all()->where('kode_mobil.tipe_FEL',true);
        // dd($hasil);
    }

    public function spklist()
    {

        $spklist = SPK::all();
        return response()->json([
            "status" => true,
            "data" => $spklist
        ]);
    }



    public function latihan()
    {
        $result = [];
        $finalresult=[];
        $latihan = SPK::pluck('Tipe')->all();
        foreach ($latihan as $minilatihan) {
            if (!in_array($minilatihan, $result, true)) {
                array_push($result, $minilatihan);
            }
        }

        foreach ($result as $val) {
            $isiresult = (object) array(
                'text' => $val,
                'value' => $val);
            array_push($finalresult, $isiresult);
        }

    }

    public function coba()
    {

        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        dd($datas);
    }
}
