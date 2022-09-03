<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SPKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('SPK')->insert([
            [
                'NOSPK' => 'B03EL22',
                'panjangstall'=>6,
                'StallUsed'=>[false,false,false,false,false,false],
                'parameter' => [
                    'kodemobil'=>"EL",
                    'modelbagasi'=>"RANGKA LANTAI",
                    'modelpintu'=>"Pintu 1",
                    'modelbangku'=>"bangku2",
                    'modelbody'=>"body welding",
                    'modeltangga'=>"tangga 2 tingkat",
                    'modellampubelakang'=>"lampu depan RH",
                    'newparameter'=>[],
                ],
                'SPKactive' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B03ELF22',
                'panjangstall'=>6,
                'StallUsed'=>[false,false,false,false,false,false],
                'parameter' => [
                    'kodemobil'=>"EL",
                    'modelbagasi'=>"RANGKA LANTAI",
                    'modelpintu'=>"Pintu 1",
                    'modelbangku'=>"bangku2",
                    'modelbody'=>"body welding",
                    'modeltangga'=>"tangga 2 tingkat",
                    'modellampubelakang'=>"lampu depan RH",
                    'newparameter'=>[],
                ],
                'SPKactive' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B05ELF22',
                'panjangstall'=>3,
                'StallUsed'=>[false,false,false],
                'parameter' => [
                    'kodemobil'=>"ELF",
                    'modelbagasi'=>"RANGKA LANTAI",
                    'modelpintu'=>"Pintu 1",
                    'modelbangku'=>"bangku2",
                    'modelbody'=>"body welding",
                    'modeltangga'=>"tangga 2 tingkat",
                    'modellampubelakang'=>"lampu depan RH",
                    'newparameter'=>[],
                ],
                'SPKactive' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B01FEL22',
                'panjangstall'=>5,
                'StallUsed'=>[false,false,false,false,false],
                'parameter' => [
                    'kodemobil'=>"FEL",
                    'modelbagasi'=>"RANGKA LANTAI",
                    'modelpintu'=>"Pintu 1",
                    'modelbangku'=>"bangku2",
                    'modelbody'=>"body welding",
                    'modeltangga'=>"tangga 2 tingkat",
                    'modellampubelakang'=>"lampu depan RH",
                    'newparameter'=>[],
                ],
                'SPKactive' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B01EL22',
                'panjangstall'=>7,
                'StallUsed'=>[false,false,false,false,false,false,false],
                'parameter' => [
                    'kodemobil'=>"EL",
                    'modelbagasi'=>"RANGKA LANTAI",
                    'modelpintu'=>"Pintu 1",
                    'modelbangku'=>"bangku2",
                    'modelbody'=>"body welding",
                    'modeltangga'=>"tangga 2 tingkat",
                    'modellampubelakang'=>"lampu depan RH",
                    'newparameter'=>[],
                ],
                'SPKactive' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
