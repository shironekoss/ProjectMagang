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
        $data = [
            [
                "kode_komponen" => "1TR2-RM5-005",
                "nama_komponen" => "LASER - ROOF MMLE 05 920",
                "qty" => "10.00000",
                "Satuan" => "PCS"
            ],
            [
                "kode_komponen" => "1TR2-RM5-001",
                "nama_komponen" => "LASER - ROOF MMLE 05 1600",
                "qty" => "6.00000",
                "Satuan" => "PCS"
            ],
        ];

        // "darirak"
        $site =   "sasasaasas";

        // $available = DB::connection('sqlsrv')
        //     ->table('ITEMKITMAINTENANCE')
        //     ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
        //     ->where('iv00102.RCRDTYPE', '=', "2")
        //     ->where('iv00102.LOCNCODE', '=', $site)
        //     ->where('ITEMKITMAINTENANCE.Component Item Description', $isikit["nama_komponen"])
        //     ->pluck("QTYONHND")
        //     ->first();

        // dd($available);
        dd($data);
    }



    public function latihan()
    {
        $masters = Master::all();
        foreach ($masters as $master) {
            $id = $master->_id;
            $kits = $master->Kit;
            $j = 0;
            foreach ($kits as $kit) {
                $isikits = $kit['IsiKit'];
                $siteid = $kit['siteID'];
                $i = 0;
                foreach ($kit['IsiKit'] as $isikit) {
                    // if($id=='6410523ccfbe5f94e20676e2'){
                    if ($siteid != null) {
                        $available = DB::connection('sqlsrv')
                            ->table('ITEMKITMAINTENANCE')
                            ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
                            ->where('iv00102.RCRDTYPE', '=', "2")
                            ->where('iv00102.LOCNCODE', '=', $siteid)
                            ->where('ITEMKITMAINTENANCE.Component Item Description', $isikit["nama_komponen"])
                            ->pluck("BINNMBR")
                            ->first();
                        $isikits[$i]["darirak"] = "";
                        $i++;
                    }
                    // }
                }
                $kits[$j]['IsiKit'] = $isikits;
                $j++;
            }
            $newmaster = Master::where('_id', $id)->first();
            $newmaster->timestamps = false;
            $newmaster->Kit = $kits;
            $newmaster->save();
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
