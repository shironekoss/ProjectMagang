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
        $available = DB::connection('sqlsrv')
            ->statement('INSERT INTO SPECIFICATION ([SPK Number],[SPK Type],[Bagian], [User Defined], [User Defined Desc], [Air Suspensi], [Semi Monocoque], [UPDATED DATETIME])
        SELECT [SPK Number],[SPK Type],[Bagian], [User Defined], [User Defined Desc], [Air Suspensi], [Semi Monocoque], GETDATE() [UPDATE DATETIME] FROM PROGRAMSPK_specification E where not exists 
        (select [spk number] from SPECIFICATION f where e.[spk number]=f.[spk number])');

        //         insert into ITEMKITMAINTENANCE ([Item KIT Number],[Item KIT Description],[Component Item Number],[Component Item Description],
        // [Component Item QTY],[Component Item UofM],[Site ID],[Updated DateTime])
        // select [Item KIT Number],[Item KIT Description],[Component Item Number],[Component Item Description],
        // [Component Item QTY],[Component Item UofM],[Site ID],getdate() [Updated DateTime]
        // from PROGRAMSPK_ITEMKIT 



        dd($available);
    }

    public function coba()
    {
        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        dd($datas);
    }
}
