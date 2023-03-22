<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Departemen;
use App\Models\History;
use App\Models\Komponen;
use App\Models\Master;
use App\Models\Masterkit;
use App\Models\SavedConversionResult;
use App\Models\TempMasterkit;
use App\Models\SPK;
use App\Models\SPK_attribute_tambahan;
use App\Models\Stall;
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
        $Departemen = 'Departemen Trimming Minibus';
        $listdata = [];
        $allhistory = History::all();

        foreach ($allhistory as $history) {
            $cluster = [];
            foreach ($history["LISTSPK"] as $idspk) {
                $data = SavedConversionResult::where('_id', $idspk)->first();
                if ($data->Departemen == $Departemen) {
                    if (array_push($cluster, $data)) {
                        $cluster['updated_at'] = $history["updated_at"];
                        $cluster['target'] = $history["_id"];
                    }
                }
            }
            array_push($listdata, $cluster);
        }
        dd($listdata);
    }

    public function coba()
    {
        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        dd($datas);
    }
}
