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
        $data = SPK::where('NOSPK', "A01JM22")->first();
        $master = Master::all();
        $i = 0;
        $results = [];
        $result = [];
        $errors = [];
        $parameteroModelMobilTerdaftar = false;
        $parameterTinggiTerdaftar = false;
        $parameterTipeMobilTerdaftar = false;
        $parameterNewparamTerdaftar = false;
        foreach ($master as $item2) {
            $ModelMobilterdaftar = false;
            $TinggiMobilterdaftar = false;
            $TipeMobilTerdaftar = false;
            $newparameterTerdaftar = false;
            foreach ($item2["Parameter"]["ModelMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["ModelMobil"])) {
                    $ModelMobilterdaftar = true;
                    $parameteroModelMobilTerdaftar = true;
                    break;
                }
            }
            foreach ($item2["Parameter"]["TinggiMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["TinggiMobil"])) {
                    $TinggiMobilterdaftar = true;
                    $parameterTinggiTerdaftar = true;
                    break;
                }
            }
            foreach ($item2["Parameter"]["TipeMobil"] as $subitem2) {
                if (strtoupper($subitem2) == strtoupper($data["parameter"]["TipeMobil"])) {
                    $TipeMobilTerdaftar = true;
                    $parameterTipeMobilTerdaftar = true;
                    break;
                }
            }
            if (count($item2["Parameter"]["NewParameter"]) == 0) {
                $newparameterTerdaftar = true;
            } else {
                if (count($item2["Parameter"]["NewParameter"]) > 0) {
                    $jumlahSPKnewparam = 0;
                    foreach ($data["parameter"]["newparameter"] as $subnewparam) {
                        foreach ($item2["Parameter"]["NewParameter"] as $databaseparam) {
                            if (strtoupper($subnewparam["Newparam"] == strtoupper($databaseparam["Newparam"]))) {
                                $isisama = false;
                                foreach ($subnewparam["Component"] as $componentspk) {
                                    foreach ($databaseparam["Component"] as $componentdatabase) {
                                        if (strtoupper($componentspk) == strtoupper($componentdatabase)) {
                                            $isisama = true;
                                            break;
                                        }
                                    }
                                    if ($isisama) {
                                        $jumlahSPKnewparam++;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    if ($jumlahSPKnewparam == count($item2["Parameter"]["NewParameter"])) {
                        $newparameterTerdaftar = true;
                        $parameterNewparamTerdaftar = true;
                    }
                }
            }
            if ($ModelMobilterdaftar && $TinggiMobilterdaftar && $TipeMobilTerdaftar && $newparameterTerdaftar) {
                $tempkit =[];
                $kitfinal = $item2["Kit"][0];
                foreach ($item2["Kit"] as $kit) {
                    $tempIsikit = [];
                    foreach ($kit["IsiKit"] as $isikit) {
                        $available = DB::connection('sqlsrv')
                            ->table('ITEMKITMAINTENANCE')
                            ->join('iv00102', 'iv00102.ITEMNMBR', '=', 'ITEMKITMAINTENANCE.Component Item Number')
                            ->where('iv00102.RCRDTYPE', '=', "2")
                            ->where('iv00102.LOCNCODE', '=', $kit["siteID"])
                            ->where('ITEMKITMAINTENANCE.Component Item Description', $isikit["nama_komponen"])
                            ->pluck("QTYONHND")
                            ->first();
                        $isikit["Qty_Available"]=$available;
                        array_push($tempIsikit,$isikit);
                    }
                    array_push($tempkit,$tempIsikit);
                }
            
                $kitfinal["IsiKit"]=$tempkit[0];
                array_push($result, $kitfinal);
                $i++;

            }
            if ($i > 0) {
                array_push($results, [
                    'kit' => $result[0],
                    'NoSPK' => $data["NOSPK"],
                ]);
            }
        }
        if (!$parameteroModelMobilTerdaftar) {
            array_push($errors, " Model Mobil Tidak Terdaftar");
        }
        if (!$parameterTinggiTerdaftar) {
            array_push($errors, " Tinggi Mobil Tidak Terdaftar");
        }
        if (!$parameterTipeMobilTerdaftar) {
            array_push($errors, " Tipe Mobil Tidak Terdaftar");
        }
        if (!$parameterNewparamTerdaftar) {
            array_push($errors, " Ada parameter baru yang belum terdaftar");
        }
        dd($results);
    }

    public function tambahSPK(Request $request)
    {
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

    public function coba()
    {

        $datas = DB::connection('sqlsrv')->table('SURATPERINTAHKERJA')
            ->join('SPECIFICATION', 'SPECIFICATION.SPK Number', '=', 'SURATPERINTAHKERJA.SPK Number')
            ->get();
        dd($datas);
    }
}
