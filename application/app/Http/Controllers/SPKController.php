<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Komponen;
use App\Models\SPK;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class SPKController extends Controller
{
    public function filternospk()
    {
        // $teks1 = "B05JM22";


        // $regex = "/[A-Z]{2,5}+/";
        // $hasil = [];

        // preg_match_all($regex, $teks1, $hasil);

        // # kembalikan data dalam bentuk json
        // dd($hasil[0][0]);
        $hasil=Komponen::all()->where('kode_mobil.tipe_FEL',true);
        dd($hasil);
    }

    public function tambahSPK(Request $request)
    {

        $validated = $request->validate([
            'NoSPK' => 'required|min:5|max:20|unique:App\Models\Account,account_username',
            'Nama' => 'required',
            'Alamat' => 'required',
            'TanggalPenerimaan' => 'required',
            'TanggalSPK' => 'required',
            'Status' => 'required',
            'Mobil.Merk' => 'required',
            'Mobil.Type_model' => 'required',
            'Mobil.Year' => 'required',
            'Mobil.NoSeries' => 'required',
            'Mobil.NoRangka' => 'required',

        ]);



        // $newmobil =SPK::create([
        //     "NoSPK"=>$request->NoSPK,
        //     "Nama"=>$request->Nama,
        //     "Alamat"=>$request->Alamat,
        //     "TanggalPenerimaan"=>$request->TanggalPenerimaan,
        //     "TanggalSPK"=>$request->TanggalSPK,
        //     "Status"=>$request->Status,
        //     'Mobil'=>[
        //         'Merk' => $request->Mobil["Merk"],
        //         'Type_model' => $request->Mobil["Type_model"],
        //         'Year' => $request->Mobil["Year"],
        //         'NoSeries' => $request->Mobil["NoSeries"],
        //         'NoRangka' => $request->Mobil["NoRangka"],
        //         'Keterangan' => $request->Mobil["Keterangan"],
        //     ],
        //     "status_SPK"=>false,
        //     "Last_edit"=>"",
        // ]);

        $newmobil =SPK::create([
            "NoSPK"=>$request->NoSPK,
            "Nama"=>$request->Nama,
            "Alamat"=>$request->Alamat,
            "TanggalPenerimaan"=>$request->TanggalPenerimaan,
            "TanggalSPK"=>$request->TanggalSPK,
            "Status"=>$request->Status,
            'Mobil'=>$request->Mobil,
            "status_SPK"=>false,
            "Last_edit"=>"",
        ]);



        return response()->json([
            "status" =>true,
            "message" =>'Data user berhasil disimpan',
            "data"=>$newmobil
        ]);
        // return response()->json([
        //     "data"=>$request
        // ]);

        // NoSPK: '',
        // Nama: '',
        // Alamat: '',
        // TanggalPenerimaan: '',
        // TanggalSPK: '',
        // Status: '',
        // Mobil: {
        //     Merk: '',
        //     Type_model: '',
        //     Year: '',
        //     NoSeries: '',
        //     NoRangka: '',
        //     Keterangan: '',
    }
}
