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
                'parameter' => [
                    'ModelMobil' => "Tesla",
                    'TinggiMobil' => "130",
                    'TipeMobil' => "MobilHR",
                    'newparameter' => [],
                ],
                'SPKactive'=>true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B03ELF22',
                'parameter' => [
                    'ModelMobil' => "Honda",
                    'TinggiMobil' => "180",
                    'TipeMobil' => "Mobil HC",
                    'newparameter' => [],
                ],
                'SPKactive'=>true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B05ELF22',
                'parameter' => [
                    'ModelMobil' => "Mitsubishi",
                    'TinggiMobil' => "200",
                    'TipeMobil' => "Mobil AK",
                    'newparameter' => [],
                ],
                'SPKactive'=>true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'NOSPK' => 'B10ELF22',
                'parameter' => [
                    'ModelMobil' => "Yamaha",
                    'TinggiMobil' => "200",
                    'TipeMobil' => "KK",
                    'newparameter' => [
                        'Newparam'=>"Bangku",
                        'Component'=>"test"
                    ],
                ],
                'SPKactive'=>true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
