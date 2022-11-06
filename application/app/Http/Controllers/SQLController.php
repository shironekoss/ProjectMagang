<?php

namespace App\Http\Controllers;

use App\Models\Masterkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLController extends Controller
{
    public function getdatakit(Request $request)
    {
         try {
            $datas = DB::connection('sqlsrv')->table('ITEMKITMAINTENANCE')->get();
            foreach ($datas as $data) {
                $datatersimpan = Masterkit::where('kode_kit', trim($data->{'Item KIT Number'}))->first();
                if ($datatersimpan == null) {
                    $newdata = Masterkit::create([
                        "kode_kit" =>  trim($data->{'Item KIT Number'}),
                        'nama_kit' => trim($data->{'Item KIT Description'}),
                        'komponen' => [
                            [
                                'kode_komponen' => trim($data->{'Component Item Number'}),
                                // 'deskripsi_komponen' => trim($data->{'Component Item Number'},
                                'nama_komponen' => trim($data->{'Component Item Description'}),
                                'qty' =>   trim($data->{'Component Item QTY'}),
                                'Satuan' => trim($data->{'Component Item UofM'}),
                            ],
                        ],
                    ]);
                } else {
                    $terdaftar = false;
                    $array = $datatersimpan->komponen;
                    foreach ($array as $saved) {
                        if ($saved['kode_komponen'] === trim($data->{'Component Item Number'})) {
                            $terdaftar = true;
                        }
                    }
                    if (!$terdaftar) {
                        array_push($array, [
                            'kode_komponen' => trim($data->{'Component Item Number'}),
                            'nama_komponen' => trim($data->{'Component Item Description'}),
                            'qty' =>   trim($data->{'Component Item QTY'}),
                            'Satuan' => trim($data->{'Component Item UofM'}),
                        ]);
                        $datatersimpan->komponen = $array;
                        $datatersimpan->save();
                    } else {
                        $index = 0;
                        foreach ($array as $saved) {
                            if ($saved['kode_komponen'] === trim($data->{'Component Item Number'})) {
                                if ($saved['nama_komponen'] != trim($data->{'Component Item Description'}) || $saved['qty'] != trim($data->{'Component Item QTY'}) || $saved['Satuan'] != trim($data->{'Component Item UofM'})) {
                                    $new = array(
                                        'kode_komponen' => trim($data->{'Component Item Number'}),
                                        'nama_komponen' => trim($data->{'Component Item Description'}),
                                        'qty' =>   trim($data->{'Component Item QTY'}),
                                        'Satuan' => trim($data->{'Component Item UofM'}),
                                    );
                                    $array[$index] = $new;
                                    $datatersimpan->komponen = $array;
                                    $datatersimpan->save();
                                }
                            }
                            $index++;
                        }
                    }
                }
            }
            return response()->json([
                "statusresponse" => 200,
                'message' => "Kit Berhasil Ditarik",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "statusresponse" => 400,
                'message' => "Gagal tarik data kit",
            ]);
        }

    }
}
