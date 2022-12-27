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
        // $Departemen = Departemen::all();
        $Departemen = Departemen::where('Nama_Departemen', "Departemen Body Welding")->first();
        $spklist = SPK::whereIn('Tipe', $Departemen->AksesTipeDatabase)
            ->get();

        $result = [];
        foreach ($spklist as $spk) {
            $insert = true;
            foreach ($spk["check"] as $check) {
                if (array_key_exists("Departemen Trimming Minibus221", $check)) {
                    if (isset($check["Departemen Trimming Minibus221"])) {
                        if ($check["Departemen Trimming Minibus221"]) {
                            $insert = false;
                            break;
                        }
                    }
                }
            }
            if ($insert) {
                array_push($result, $spk->NOSPK);
            }
        }
        // ->pluck('NOSPK');
        dd($result);
    }

    public function coba()
    {

        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        dd($datas);
    }
}
