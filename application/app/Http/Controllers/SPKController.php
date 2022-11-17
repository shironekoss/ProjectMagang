<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
        $allsaved = SavedConversionResult::where('NOSPK','!=',"STOCK")->get(['NOSPK','Departemen','namastall','stall']);
        dd($allsaved);


    }

    public function tambahSPK(Request $request)
    {

        // $validated = $request->validate([
        //     'NoSPK' => 'required|min:5|max:20|unique:App\Models\Account,account_username',
        //     'Nama' => 'required',
        //     'Alamat' => 'required',
        //     'TanggalPenerimaan' => 'required',
        //     'TanggalSPK' => 'required',
        //     'Status' => 'required',
        //     'Mobil.Merk' => 'required',
        //     'Mobil.Type_model' => 'required',
        //     'Mobil.Year' => 'required',
        //     'Mobil.NoSeries' => 'required',
        //     'Mobil.NoRangka' => 'required',

        // ]);
        $newmobil = SPK::create([
            "NoSPK" => $request->NoSPK,
            "Nama" => $request->Nama,
            "Alamat" => $request->Alamat,
            "TanggalPenerimaan" => $request->TanggalPenerimaan,
            "TanggalSPK" => $request->TanggalSPK,
            "Status" => $request->Status,
            'Mobil' => $request->Mobil,
            "status_SPK" => false,
            "Last_edit" => "",
        ]);
        return response()->json([
            "status" => true,
            "message" => 'Data user berhasil disimpan',
            "data" => $newmobil
        ]);
    }
}
